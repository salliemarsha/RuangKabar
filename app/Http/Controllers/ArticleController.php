<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    private function authorizeArticle(Article $article)
        {
            if (auth()->user()->role === 'admin') {
                return;
            }

            if ($article->user_id !== auth()->id()) {
                abort(403);
            }
        }
    public function index(Request $request)
{
    $search = $request->search;

    $articles = Article::with(['category', 'user', 'tags'])
        ->when(auth()->check() && auth()->user()->role === 'pengguna', function ($query) {
            $query->where('status', 'published');
        })
        ->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('articles.index', compact('articles', 'search'));
}
    public function report()
    {
        $articles = Article::with(['category', 'user'])
            ->latest()
            ->get();

        return view('reports.articles', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();
        $tags = \App\Models\Tag::orderBy('name')->get();

        return view('articles.create', compact('categories', 'tags'));
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $article = Article::create($data);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect('/articles')->with(
            'success',
            'Artikel berhasil ditambahkan.'
        );
    }

        public function show(Article $article)
    {
        $article->load(['category',
         'user',
        'tags',
        'comments' => function ($query) {
                $query->where('status', 'approved')
                    ->with('user')
                    ->latest();
            }]);

        return view('articles.show', compact('article'));
    }

        public function edit(Article $article)
    {
        $this->authorizeArticle($article);

        $categories = \App\Models\Category::orderBy('name')->get();
        $tags = \App\Models\Tag::orderBy('name')->get();

        $article->load('tags');

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }
    
        public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        $article->tags()->sync($request->tags ?? []);

        return redirect('/articles')->with(
            'success',
            'Artikel berhasil diperbarui.'
        );
    }

        public function destroy(Article $article)
    {
        $this->authorizeArticle($article);
        
        $article->delete();

        return redirect('/articles')->with(
            'success',
            'Artikel berhasil dihapus.'
        );
    }
}

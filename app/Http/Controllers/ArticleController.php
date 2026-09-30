<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user', 'tags'])
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
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
            'image' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

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
        $article->load(['category', 'user', 'tags']);

        return view('articles.show', compact('article'));
    }

        public function edit(Article $article)
    {
        $categories = \App\Models\Category::orderBy('name')->get();
        $tags = \App\Models\Tag::orderBy('name')->get();

        $article->load('tags');

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }
    
        public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

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
        $article->delete();

        return redirect('/articles')->with(
            'success',
            'Artikel berhasil dihapus.'
        );
    }
}

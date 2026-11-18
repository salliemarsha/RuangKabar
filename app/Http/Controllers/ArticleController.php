<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ReadingHistory;
use App\Models\Tag;
use App\Notifications\WriterActivityNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    private function authorizeArticle(Article $article)
    {
        $user = auth()->user();

        abort_unless(
            $user && (
                $user->role === 'admin' ||
                (
                    $user->role === 'penulis' &&
                    (int) $article->user_id === (int) $user->id
                )
            ),
            403
        );
    }

    private function redirectAfterWrite(string $message, ?string $returnTo = null)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $base = route('admin.articles.index');

            $target = ($returnTo === $base || ($returnTo && str_starts_with($returnTo, $base.'?')))
                ? $returnTo
                : $base;

            return redirect($target)->with('success', $message);
        }

        if ($user && $user->role === 'penulis' && Route::has('penulis.articles.index')) {
            return redirect()->route('penulis.articles.index')->with('success', $message);
        }

        return redirect()->route('articles.index')->with('success', $message);
    }

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $articles = Article::with(['category', 'user', 'tags'])
            ->where('status', 'published')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('articles.index', compact('articles', 'search'));
    }

    public function adminIndex(Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);

        $rawSearch = $request->query('search');
        $search = is_string($rawSearch) ? trim($rawSearch) : '';

        $status = in_array($request->query('status'), ['published', 'draft'], true)
            ? $request->query('status')
            : '';

        $rawCategory = $request->query('category');
        $categoryId = is_string($rawCategory) && ctype_digit($rawCategory)
            ? (int) $rawCategory
            : 0;

        $articles = Article::with(['category:id,name', 'user:id,name'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%'.addcslashes($search, '%_\\').'%');
            })
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($categoryId > 0, fn ($query) => $query->where('category_id', $categoryId))
            ->latest('updated_at')
            ->paginate(10)
            ->withQueryString();

        if ($articles->isEmpty() && $articles->currentPage() > 1) {
            return redirect()->route('admin.articles.index', array_merge(
                $request->query(),
                ['page' => $articles->lastPage()]
            ));
        }

        $byStatus = Article::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $stats = [
            'total' => (int) $byStatus->sum(),
            'published' => (int) ($byStatus['published'] ?? 0),
            'draft' => (int) ($byStatus['draft'] ?? 0),
            'authors' => Article::whereNotNull('user_id')
                ->distinct()
                ->count('user_id'),
        ];

        $categories = Category::orderBy('name')
            ->get(['id', 'name', 'is_active']);

        return view('admin.articles.index', compact(
            'articles',
            'search',
            'status',
            'categoryId',
            'categories',
            'stats'
        ));
    }

    public function writerIndex(Request $request)
    {
        $user = auth()->user();

        abort_unless($user && $user->role === 'penulis', 403);

        $search = trim((string) $request->query('search', ''));

        $status = in_array($request->query('status'), ['published', 'draft'], true)
            ? $request->query('status')
            : '';

        $articles = Article::with(['category', 'user', 'tags'])
            ->where('user_id', $user->id)
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest('updated_at')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Article::where('user_id', $user->id)->count(),
            'published' => Article::where('user_id', $user->id)
                ->where('status', 'published')
                ->count(),
            'draft' => Article::where('user_id', $user->id)
                ->where('status', 'draft')
                ->count(),
        ];

        return view('penulis.articles.index', compact(
            'articles',
            'search',
            'status',
            'stats'
        ));
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
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $tags = Tag::orderBy('name')->get();

        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('is_active', true);
                }),
            ],
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

        $article->tags()->sync($request->input('tags', []));

        return $this->redirectAfterWrite('Artikel berhasil ditambahkan.');
    }

    public function show(Article $article)
    {
        $user = auth()->user();

        if ($article->status !== 'published') {
            abort_unless(
                $user && (
                    $user->role === 'admin' ||
                    (
                        $user->role === 'penulis' &&
                        (int) $article->user_id === (int) $user->id
                    )
                ),
                404
            );
        }

        $article->load([
            'category',
            'user',
            'tags',
            'comments' => function ($query) {
                $query->where('status', 'approved')
                    ->with('user')
                    ->latest();
            },
        ]);

        if ($user && $user->role === 'pengguna' && $article->status === 'published') {
            ReadingHistory::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'article_id' => $article->id,
                ],
                [
                    'last_read_at' => now(),
                ]
            );
        }

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorizeArticle($article);

        $categories = Category::where(function ($query) use ($article) {
            $query->where('is_active', true)
                ->orWhere('id', $article->category_id);
        })
            ->orderBy('name')
            ->get();

        $tags = Tag::orderBy('name')->get();

        $article->load('tags');

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) use ($article) {
                    $query->where('is_active', true)
                        ->orWhere('id', $article->category_id);
                }),
            ],
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $oldStatus = $article->status;

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        $article->tags()->sync($request->input('tags', []));

        if (
            auth()->user()->role === 'admin' &&
            $oldStatus !== $article->status
        ) {
            $article->loadMissing('user');

            if ($article->user && $article->user->role === 'penulis') {
                $statusLabel = $article->status === 'published'
                    ? 'diterbitkan'
                    : 'dikembalikan menjadi draft';

                $article->user->notify(
                    new WriterActivityNotification(
                        'article_status_changed',
                        'Status artikel Anda telah '.$statusLabel.' oleh Admin.',
                        $article->status === 'published'
                            ? route('articles.show', $article)
                            : route('articles.index'),
                        $article->title
                    )
                );
            }
        }

        return $this->redirectAfterWrite('Artikel berhasil diperbarui.');
    }

    public function destroy(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $article->delete();

        return $this->redirectAfterWrite(
            'Artikel berhasil dihapus.',
            $request->input('return_to')
        );
    }
}

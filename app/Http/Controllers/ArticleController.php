<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('articles.create', compact('categories'));
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect('/articles')->with(
            'success',
            'Artikel berhasil ditambahkan.'
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $totalArticles = Article::where('user_id', $userId)->count();
        $publishedArticles = Article::where('user_id', $userId)->where('status', 'published')->count();
        $draftArticles = Article::where('user_id', $userId)->where('status', 'draft')->count();

        $articles = Article::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        return view('penulis.dashboard', compact('totalArticles', 'publishedArticles', 'draftArticles', 'articles'));
    }
}
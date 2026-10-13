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

        return view('penulis.dashboard', compact('totalArticles', 'publishedArticles', 'draftArticles'));
    }
}
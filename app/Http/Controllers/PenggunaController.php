<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function beranda()
    {
        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('pengguna.beranda', compact('articles'));
    }
}
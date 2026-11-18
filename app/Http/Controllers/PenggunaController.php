<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ReadingHistory;

class PenggunaController extends Controller
{
    public function beranda()
    {
        $user = auth()->user();

        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        $readingHistories = ReadingHistory::with([
                'article.category',
                'article.user',
            ])
            ->where('user_id', $user->id)
            ->latest('last_read_at')
            ->take(4)
            ->get();

        $latestAuthorApplication = $user->authorApplications()
            ->latest()
            ->first();

        return view('pengguna.beranda', compact(
            'articles',
            'readingHistories',
            'latestAuthorApplication'
        ));
    }
}

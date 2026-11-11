<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ReportController extends Controller
{
    public function articles()
    {
        $articles = Article::with(['category', 'user'])
            ->latest()
            ->get();

        $totalArticles = Article::count();

        $publishedArticles = Article::where('status', 'published')
            ->count();

        $draftArticles = Article::where('status', 'draft')
            ->count();

        $totalAuthors = Article::distinct('user_id')
            ->whereNotNull('user_id')
            ->count('user_id');

        $startDate = now()->subMonths(5)->startOfMonth();

        $monthlyCounts = Article::selectRaw(
            'YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total'
        )
            ->where('created_at', '>=', $startDate)
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->keyBy(fn ($item) => sprintf(
                '%04d-%02d',
                $item->year,
                $item->month
            ));

        $monthlyLabels = [];
        $monthlyData = [];

        for ($i = 0; $i < 6; $i++) {
            $date = $startDate->copy()->addMonths($i);
            $key = $date->format('Y-m');

            $monthlyLabels[] = $date->translatedFormat('M Y');
            $monthlyData[] = $monthlyCounts->get($key)->total ?? 0;
        }

        return view('reports.articles', compact(
            'articles',
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'totalAuthors',
            'monthlyLabels',
            'monthlyData'
        ));
    }
}

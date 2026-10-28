<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class PublicCategoryController extends Controller
{
    public function show(Category $category)
    {
        $articles = Article::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        $categories = Category::orderBy('name')->get();

        return view('categories.show', compact('category', 'articles', 'categories'));
    }
}
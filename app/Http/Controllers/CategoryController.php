<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

        public function create()
    {
        return view('categories.create');
    }

        public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:categories,name',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);

        Category::create($data);

        return redirect('/categories')->with(
            'success',
            'Kategori berhasil ditambahkan.'
        );
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

        public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);

        $category->update($data);

        return redirect('/categories')->with(
            'success',
            'Kategori berhasil diperbarui.'
        );
    }

        public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories')->with(
            'success',
            'Kategori berhasil dihapus.'
        );
    }
}

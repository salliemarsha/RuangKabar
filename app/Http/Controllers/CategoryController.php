<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'is_active' => true,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil ditambahkan.',
                'category' => $category,
            ], 201);
        }

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
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil diperbarui.',
                'category' => $category->fresh(),
            ]);
        }

        return redirect('/categories')->with(
            'success',
            'Kategori berhasil diperbarui.'
        );
    }

    public function toggleStatus(Request $request, Category $category)
    {
        $category->update([
            'is_active' => ! $category->is_active,
        ]);

        $message = $category->is_active
            ? 'Kategori berhasil diaktifkan.'
            : 'Kategori berhasil dinonaktifkan.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'category' => $category->fresh(),
            ]);
        }

        return redirect('/categories')->with('success', $message);
    }

    public function destroy(Request $request, Category $category)
    {
        $articleCount = $category->articles()->count();

        if ($articleCount > 0) {
            $message = "Kategori tidak dapat dihapus karena masih digunakan oleh {$articleCount} artikel. Silakan ubah kategori artikel terkait terlebih dahulu.";

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                ], 422);
            }

            return redirect('/categories')->with('error', $message);
        }

        $category->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil dihapus.',
            ]);
        }

        return redirect('/categories')->with(
            'success',
            'Kategori berhasil dihapus.'
        );
    }
}

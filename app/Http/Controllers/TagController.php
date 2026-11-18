<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query();

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        $tagCount = (clone $query)->count();

        $tags = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('tags.index', compact('tags', 'tagCount'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:tags,name',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $tag = Tag::create($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tag berhasil ditambahkan.',
                'tag' => $tag,
            ], 201);
        }

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:tags,name,' . $tag->id,
        ]);

        $data['slug'] = Str::slug($data['name']);

        $tag->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tag berhasil diperbarui.',
                'tag' => $tag->fresh(),
            ]);
        }

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy(Request $request, Tag $tag)
    {
        $articleCount = $tag->articles()->count();

        DB::transaction(function () use ($tag) {
            $tag->articles()->detach();
            $tag->delete();
        });

        $message = $articleCount > 0
            ? "Tag berhasil dihapus dan dilepaskan dari {$articleCount} artikel."
            : 'Tag berhasil dihapus.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
            ]);
        }

        return redirect()->route('tags.index')
            ->with('success', $message);
    }
}

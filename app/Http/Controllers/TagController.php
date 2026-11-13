<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->get();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:tags,name',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $tag = Tag::create($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tag berhasil ditambahkan.',
                'tag' => $tag,
            ], 201);
        }

        return redirect('/tags')->with(
            'success',
            'Tag berhasil ditambahkan.'
        );
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|max:100|unique:tags,name,' . $tag->id,
        ]);

        $data['slug'] = Str::slug($data['name']);

        $tag->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tag berhasil diperbarui.',
                'tag' => $tag->fresh(),
            ]);
        }

        return redirect('/tags')->with(
            'success',
            'Tag berhasil diperbarui.'
        );
    }

    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Tag berhasil dihapus.',
            ]);
        }

        return redirect('/tags')->with(
            'success',
            'Tag berhasil dihapus.'
        );
    }
}
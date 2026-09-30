<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['article', 'user'])
            ->latest()
            ->paginate(10);

        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'comment' => 'required',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Comment::create($data);

        return redirect('/articles/' . $data['article_id'])
        ->with('success', 'Komentar berhasil dikirim dan menunggu moderasi.');
    }

    public function show(Comment $comment)
    {
        $comment->load(['article', 'user']);

        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $comment->update($data);

        return redirect('/comments')->with(
            'success',
            'Status komentar berhasil diperbarui.'
        );
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect('/comments')->with(
            'success',
            'Komentar berhasil dihapus.'
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentModerator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private const STATUSES = ['approved', 'pending', 'rejected'];

    public function index(Request $request)
    {
        $status = in_array($request->query('status'), self::STATUSES, true) ? $request->query('status') : null;
        $search = trim((string) $request->query('search'));

        $comments = Comment::with(['article:id,title', 'user:id,name'])
            ->when($status, fn ($query, $s) => $query->where('status', $s))
            ->when($search !== '', function ($query) use ($search) {
                $like = '%' . addcslashes($search, '%_\\') . '%';

                $query->where(function ($query) use ($like) {
                    $query->where('comment', 'like', $like)
                        ->orWhere('flag_reason', 'like', $like)
                        ->orWhereHas('user', fn ($u) => $u->where('name', 'like', $like))
                        ->orWhereHas('article', fn ($a) => $a->where('title', 'like', $like));
                });
            })
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Halaman kosong setelah menghapus item terakhir di halaman tersebut.
        if ($comments->isEmpty() && $comments->currentPage() > 1) {
            return redirect()->route('comments.index', array_merge(
                $request->query(),
                ['page' => $comments->lastPage()]
            ));
        }

        $counts = Comment::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');

        $stats = [
            'all' => (int) $counts->sum(),
            'approved' => (int) ($counts['approved'] ?? 0),
            'pending' => (int) ($counts['pending'] ?? 0),
            'rejected' => (int) ($counts['rejected'] ?? 0),
        ];

        return view('comments.index', compact('comments', 'stats', 'status', 'search'));
    }

    public function create()
    {
        return view('comments.index');
    }

    public function store(Request $request, CommentModerator $moderator)
    {
        $data = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'comment' => 'required|string|max:' . config('moderation.thresholds.max_length'),
        ]);

        $data['comment'] = trim($data['comment']);

        $result = $moderator->analyze($data['comment'], auth()->id());

        $data['user_id'] = auth()->id();
        $data['status'] = $result['status'];
        $data['flag_reason'] = $result['reasons'] ? implode('; ', $result['reasons']) : null;

        Comment::create($data);

        $message = $result['status'] === CommentModerator::APPROVED
            ? 'Komentar berhasil dikirim dan sudah tampil.'
            : 'Komentar berhasil dikirim dan menunggu moderasi.';

        return redirect('/articles/' . $data['article_id'])->with('success', $message);
    }

    public function show(Comment $comment)
    {
        $comment->load(['article', 'user']);

        return view('comments.index', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $comment->update($data);

        $message = match ($data['status']) {
            'approved' => 'Komentar disetujui dan sekarang tampil di halaman publik.',
            'rejected' => 'Komentar ditolak dan tidak akan tampil di halaman publik.',
            default => 'Komentar dikembalikan ke status pending.',
        };

        return back()->with('success', $message);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
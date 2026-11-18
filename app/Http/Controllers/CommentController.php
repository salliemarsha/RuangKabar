<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Notifications\AdminCommentNotification;
use App\Notifications\ReaderActivityNotification;
use App\Notifications\WriterActivityNotification;
use App\Services\CommentModerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    private const STATUSES = ['approved', 'pending', 'rejected'];

    public function index(Request $request)
    {
        $status = in_array($request->query('status'), self::STATUSES, true)
            ? $request->query('status')
            : null;

        $search = trim((string) $request->query('search'));

        $comments = Comment::with(['article:id,title', 'user:id,name'])
            ->when($status, fn ($query, $s) => $query->where('status', $s))
            ->when($search !== '', function ($query) use ($search) {
                $like = '%' . addcslashes($search, '%\\_') . '%';

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

        if ($comments->isEmpty() && $comments->currentPage() > 1) {
            return redirect()->route('comments.index', array_merge(
                $request->query(),
                ['page' => $comments->lastPage()]
            ));
        }

        $counts = Comment::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

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
        $user = $request->user();

        abort_unless($user, 401);

        $data = $request->validate([
            'article_id' => 'required|integer|exists:articles,id',
            'parent_id' => 'nullable|integer|exists:comments,id',
            'comment' => 'required|string|max:' . config('moderation.thresholds.max_length'),
        ]);

        $data['comment'] = trim($data['comment']);

        if ($data['comment'] === '') {
            throw ValidationException::withMessages([
                'comment' => 'Komentar tidak boleh kosong.',
            ]);
        }

        $parent = null;

        if (!empty($data['parent_id'])) {
            $parent = Comment::whereKey($data['parent_id'])
                ->where('article_id', $data['article_id'])
                ->whereNull('parent_id')
                ->firstOrFail();

            if ($parent->status !== Comment::STATUS_APPROVED) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Komentar ini belum dapat dibalas.',
                ]);
            }

            abort_unless(
                in_array($user->role, ['admin', 'penulis', 'pengguna'], true),
                403
            );
        } else {
            abort_unless($user->role === 'pengguna', 403);
        }

        $result = $moderator->analyze($data['comment'], $user->id);

        $comment = Comment::create([
            'article_id' => $data['article_id'],
            'parent_id' => $parent?->id,
            'user_id' => $user->id,
            'comment' => $data['comment'],
            'status' => $result['status'],
            'flag_reason' => $result['reasons']
                ? implode('; ', $result['reasons'])
                : null,
        ]);

        $article = $comment->article()->with('user')->firstOrFail();

        if (
            $article->user &&
            $article->user->role === 'penulis' &&
            (int) $article->user_id !== (int) $user->id
        ) {
            $message = $parent
                ? $user->name . ' membalas komentar pada artikel Anda.'
                : $user->name . ' mengomentari artikel Anda.';

            $article->user->notify(
                new WriterActivityNotification(
                    'article_comment',
                    $message,
                    route('articles.show', $article),
                    $article->title
                )
            );
        }

        // Notifikasi admin untuk semua komentar baru, termasuk yang langsung approved.
        $admins = User::where('role', 'admin')->get();

        if ($admins->isNotEmpty()) {
            Notification::send(
                $admins,
                new AdminCommentNotification(
                    $comment->id,
                    $comment->article_id,
                    $article->title,
                    $user->name,
                    $comment->comment,
                    $comment->status
                )
            );
        }

        // Notifikasi kepada pengguna jika komentar menunggu moderasi.
        if ($user->role === 'pengguna' && $result['status'] === CommentModerator::PENDING) {
            $user->notify(
                new ReaderActivityNotification(
                    'comment_pending',
                    'Komentar Anda terindikasi mengandung kata atau frasa yang perlu ditinjau. Komentar sedang menunggu moderasi.',
                    route('articles.show', $article),
                    $article->title
                )
            );
        }

        if ($parent && $result['status'] === CommentModerator::APPROVED) {
            $parent->loadMissing('user');

            $reader = $parent->user;

            if (
                $reader &&
                $reader->role === 'pengguna' &&
                (int) $reader->id !== (int) $user->id
            ) {
                $reader->notify(
                    new ReaderActivityNotification(
                        'comment_reply',
                        $user->name . ' membalas komentar Anda.',
                        route('articles.show', $article),
                        $article->title
                    )
                );
            }
        }

        if ($parent) {
            $message = $result['status'] === CommentModerator::APPROVED
                ? 'Balasan berhasil dikirim dan sudah tampil.'
                : 'Balasan berhasil dikirim dan menunggu moderasi.';
        } else {
            $message = $result['status'] === CommentModerator::APPROVED
                ? 'Komentar berhasil dikirim dan sudah tampil.'
                : 'Komentar berhasil dikirim dan menunggu moderasi.';
        }

        return redirect('/articles/' . $data['article_id'])
            ->with('success', $message);
    }

    public function show(Comment $comment)
    {
        $comment->load(['article', 'user', 'parent', 'replies.user']);

        return view('comments.index', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $oldStatus = $comment->status;

        $comment->update($data);

        if ($oldStatus !== $data['status']) {
            $comment->load(['user', 'parent.user', 'article']);

            $commentAuthor = $comment->user;

            if ($commentAuthor && $commentAuthor->role === 'pengguna') {
                $readerMessage = match ($data['status']) {
                    'approved' => 'Komentar Anda telah disetujui dan sekarang tampil.',
                    'rejected' => 'Komentar Anda ditolak dan tidak ditampilkan.',
                    default => 'Komentar Anda sedang menunggu moderasi kembali.',
                };

                $commentAuthor->notify(
                    new ReaderActivityNotification(
                        'comment_status',
                        $readerMessage,
                        route('articles.show', $comment->article),
                        $comment->article->title
                    )
                );
            }

            if (
                $data['status'] === Comment::STATUS_APPROVED &&
                $comment->parent_id
            ) {
                $reader = $comment->parent?->user;

                if (
                    $reader &&
                    $reader->role === 'pengguna' &&
                    (int) $reader->id !== (int) $comment->user_id
                ) {
                    $reader->notify(
                        new ReaderActivityNotification(
                            'comment_reply',
                            $comment->user->name . ' membalas komentar Anda.',
                            route('articles.show', $comment->article),
                            $comment->article->title
                        )
                    );
                }
            }
        }

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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminCommentNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $commentId,
        public int $articleId,
        public string $articleTitle,
        public string $commenter,
        public string $comment,
        public string $status
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $isPending = $this->status === 'pending';

        return [
            'type' => $isPending ? 'comment_pending' : 'comment_new',
            'comment_id' => $this->commentId,
            'article_id' => $this->articleId,
            'article_title' => $this->articleTitle,
            'commenter' => $this->commenter,
            'comment' => $this->comment,
            'status' => $this->status,
            'message' => $isPending
                ? $this->commenter . ' mengirim komentar yang perlu dimoderasi.'
                : $this->commenter . ' mengirim komentar baru pada artikel ' . $this->articleTitle . '.',
            'url' => $isPending
                ? route('comments.index', ['status' => 'pending'])
                : route('comments.index'),
        ];
    }
}
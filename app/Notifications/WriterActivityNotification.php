<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WriterActivityNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $type,
        public string $message,
        public string $url,
        public ?string $articleTitle = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'article_title' => $this->articleTitle,
            'url' => $this->url,
        ];
    }
}

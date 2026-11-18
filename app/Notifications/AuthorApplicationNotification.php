<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AuthorApplicationNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $applicationId,
        public string $applicantName
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'author_application',
            'message' => $this->applicantName . ' mengajukan permohonan menjadi penulis.',
            'url' => route('admin.author-applications.index'),
        ];
    }
}

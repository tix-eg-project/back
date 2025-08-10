<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\SendNotificationHelper;
use Illuminate\Notifications\Messages\MailMessage;


class DashboardNotification extends Notification
{
    // لا تستخدم ShouldQueue و Queueable مؤقتًا
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('إشعار جديد')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line($this->message);
    }
}

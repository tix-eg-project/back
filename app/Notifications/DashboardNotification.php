<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\SendNotificationHelper;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;


class DashboardNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user_id;
    protected $message;

    public function __construct($user_id, $message)
    {
        $this->user_id = $user_id;
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable): array
    {
        $user = User::find($this->user_id);

        if ($user && $user->fcm_token) {
            $data = [
                'title_ar' => 'إشعار جديد',
                'body_ar' => $this->message,
                'title_en' => 'New Notification',
                'body_en' => $this->message,
                'title' => 'إشعار جديد',
                'body' => $this->message,
            ];

            try {
                (new SendNotificationHelper())->sendNotification($data, [$user->fcm_token]);
            } catch (\Exception $e) {
                \Log::error('FCM Error in DashboardNotification: ' . $e->getMessage());
            }
        }

        return [
            'user_id'   => $this->user_id,
            'message'   => $this->message,
            'title_ar'  => 'إشعار جديد',
            'body_ar'   => $this->message,
            'title_en'  => 'New Notification',
            'body_en'   => $this->message,
            'country'   => optional($user)->country ?? '—',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('إشعار جديد من النظام')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line($this->message)
            ->line('شكرًا لاستخدامك منصتنا!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\SendNotificationHelper;
use Modules\Orders\Enum\StatusOrderEnum;

class OrderStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $status;

    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $statusTextAr = match ($this->status) {
            StatusOrderEnum::WAITING => 'قيد الانتظار',
            StatusOrderEnum::APPROVED => 'تم التوصيل',
            StatusOrderEnum::REJECTED => 'مرفوض',
            default => 'غير معروف',
        };

        $statusTextEn = match ($this->status) {
            StatusOrderEnum::WAITING => 'Pending',
            StatusOrderEnum::APPROVED => 'Delivered',
            StatusOrderEnum::REJECTED => 'Rejected',
            default => 'Unknown',
        };

        $data = [
            'title_ar' => 'تحديث حالة الطلب',
            'body_ar' => 'تم تغيير حالة طلبك رقم #' . $this->order->id . ' إلى: ' . $statusTextAr,
            'title_en' => 'Order Status Updated',
            'body_en' => 'Your order #' . $this->order->id . ' status has been updated to: ' . $statusTextEn,
            'order_id' => $this->order->id,
        ];

        if ($notifiable->fcm_token) {
            try {
                (new SendNotificationHelper())->sendNotification($data, [$notifiable->fcm_token]);
            } catch (\Exception $e) {
                \Log::error('FCM error in OrderStatusChangedNotification: ' . $e->getMessage());
            }
        }

        return $data;
    }
}

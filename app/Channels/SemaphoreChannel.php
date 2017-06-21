<?php
namespace App\Channels;

use App\Services\SMSMessage;
use Illuminate\Notifications\Notification;

class SemaphoreChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $semaphore = $notification->toSemaphore($notifiable);

        if (! $semaphore instanceof SMSMessage) {
            throw new \Exception('Invalid message');
        }

        // Send notification to the $notifiable instance...
        $mobileNumber = $notifiable->mobile_number;

        $semaphore->setTo($mobileNumber)
            ->send();
    }
}
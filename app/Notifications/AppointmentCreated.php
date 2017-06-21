<?php

namespace App\Notifications;

use App\Channels\SemaphoreChannel;
use App\Services\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppointmentCreated extends Notification
{
    use Queueable;

    protected $queueNumber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($queueNumber)
    {
        $this->queueNumber = $queueNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SemaphoreChannel::class, 'database'];
    }

    public function toSemaphore($notifiable)
    {
        $message = "Your QUEUE #: ".$this->queueNumber;

        return (new SMSMessage())
            ->setMessage($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'   => "Your QUEUE #: ".$this->queueNumber
        ];
    }
}

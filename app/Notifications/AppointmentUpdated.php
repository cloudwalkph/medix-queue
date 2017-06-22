<?php

namespace App\Notifications;

use App\Channels\SemaphoreChannel;
use App\Services\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentUpdated extends Notification
{
    use Queueable;

    protected $queueLocal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($queueLocal)
    {
        $this->queueLocal = $queueLocal;
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
        $message = "Your QUEUE #: ".$this->queueLocal->queue_number . " please proceed to " . $this->queueLocal->facility;

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
            'message'   => "QUEUE #: ".$this->queueLocal->queue_number." please proceed to " . $this->queueLocal->facility
        ];
    }
}

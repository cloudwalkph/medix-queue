<?php

namespace App\Listeners;

use App\Events\QueueUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQueueNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueueUpdated  $event
     * @return void
     */
    public function handle(QueueUpdated $event)
    {
        //
    }
}

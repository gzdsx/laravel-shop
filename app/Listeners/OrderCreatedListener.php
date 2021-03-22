<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\SendOrderCreatedNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
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
     * @param OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        dispatch(new SendOrderCreatedNotice($event->order));
    }
}

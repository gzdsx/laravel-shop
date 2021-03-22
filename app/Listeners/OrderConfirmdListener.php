<?php

namespace App\Listeners;

use App\Events\OrderConfirmd;
use App\Jobs\SendOrderConfirmedNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderConfirmdListener
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
     * @param OrderConfirmd $event
     * @return void
     */
    public function handle(OrderConfirmd $event)
    {
        dispatch(new SendOrderConfirmedNotice($event->order));
    }
}

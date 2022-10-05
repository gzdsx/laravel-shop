<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderConfirmed;
use App\Jobs\SendOrderConfirmedNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderConfirmedListener
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
     * @param OrderConfirmed $event
     * @return void
     */
    public function handle(OrderConfirmed $event)
    {
        dispatch(new SendOrderConfirmedNotice($event->order));
    }
}

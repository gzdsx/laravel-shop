<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderSend;
use App\Jobs\SendOrderSendNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderSendListener
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
     * @param OrderSend $event
     * @return void
     */
    public function handle(OrderSend $event)
    {
        dispatch(new SendOrderSendNotice($event->order));
    }
}

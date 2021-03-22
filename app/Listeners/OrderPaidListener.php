<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Jobs\SendOrderPaidNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderPaidListener
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
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        dispatch(new SendOrderPaidNotice($event->order));
    }
}

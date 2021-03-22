<?php

namespace App\Listeners;

use App\Events\OrderClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderClosedListener
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
     * @param  OrderClosed  $event
     * @return void
     */
    public function handle(OrderClosed $event)
    {
        //
    }
}

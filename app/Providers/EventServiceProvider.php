<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Overtrue\LaravelWeChat\Events\WeChatUserAuthorized;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        WeChatUserAuthorized::class => [
            'App\Listeners\Auth\WeChatUserAuthorizedListener'
        ],
        Registered::class => [
            'App\Listeners\Auth\RegisteredListener'
        ],
        Login::class => [
            'App\Listeners\Auth\LoginListener'
        ],
        Logout::class => [
            'App\Listeners\Auth\LogoutListener'
        ],
        'App\Events\Order\OrderCreated' => [
            'App\Listeners\Order\OrderCreatedListener'
        ],
        'App\Events\Order\OrderPaid' => [
            'App\Listeners\Order\OrderPaidListener'
        ],
        'App\Events\Order\OrderSend' => [
            'App\Listeners\Order\OrderSendListener'
        ],
        'App\Events\Order\OrderConfirmed' => [
            'App\Listeners\Order\OrderConfirmedListener'
        ],
        'App\Events\Order\OrderCancelled' => [
            'App\Listeners\Order\OrderCancelledListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

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
            'App\Listeners\WeChatUserAuthorizedListener'
        ],
        Registered::class => [
            'App\Listeners\RegisteredListener'
        ],
        Login::class => [
            'App\Listeners\LoginListener'
        ],
        Logout::class => [
            'App\Listeners\LogoutListener'
        ],
        'App\Events\OrderCreated'=>[
            'App\Listeners\OrderCreatedListener'
        ],
        'App\Events\OrderPaid'=>[
            'App\Listeners\OrderPaidListener'
        ],
        'App\Events\OrderSend'=>[
            'App\Listeners\OrderSendListener'
        ],
        'App\Events\OrderConfirmd'=>[
            'App\Listeners\OrderConfirmdListener'
        ],
        'App\Events\OrderClosed'=>[
            'App\Listeners\OrderClosedListener'
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

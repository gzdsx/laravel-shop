<?php

namespace App\Providers;

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
        'App\Events\UserEvent' => [
            'App\Listeners\UserEventListener'
        ],
        'App\Events\OrderEvent' => [
            'App\Listeners\OrderEventListener'
        ],
        WeChatUserAuthorized::class => [
            'App\Listeners\WeChatUserAuthorizedListener'
        ]
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

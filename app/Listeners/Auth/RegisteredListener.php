<?php

namespace App\Listeners\Auth;

use App\Notifications\RegisteredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredListener
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->logs()->create([
            'ip' => request()->getClientIp(),
            'operate' => 'register',
            'src' => request()->input('src', 'web')
        ]);

        if (settings('send_wellcome_msg') == '1'){
            $event->user->notify(new RegisteredNotification());
        }
    }
}

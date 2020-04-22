<?php

namespace App\Listeners;

use App\Events\UserEvent;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    use WechatDefaultConfig;

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
     * @param  UserEvent $event
     * @return void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle(UserEvent $event)
    {
        //用户登录时触发
        if ($event->type == 'loggedin')
        {
            $event->user->logs()->create([
                'ip'=>request()->getClientIp(),
                'operate'=>'login',
                'created_at'=>time(),
                'src'=>request()->input('src', 'web')
            ]);
        }

        //用户注册时触发
        if ($event->type == 'register')
        {

        }

        //会员升级是出发
        if ($event->type == 'upgrade')
        {

        }
    }
}

<?php

namespace App\Listeners;


use App\Services\Wechat\OfficialAccountService;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelWeChat\Events\WeChatUserAuthorized;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeChatUserAuthorizedListener
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
     * @param WeChatUserAuthorized $event
     * @return void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function handle(WeChatUserAuthorized $event)
    {
        /**
         * 'openid'=>'',
         * 'nickname'=>'',
         * 'sex'=>'',
         * 'province'=>'',
         * 'city'=>'',
         * 'country'=>'',
         * 'headimgurl'=>'',
         * 'privilege'=>'',
         * 'unionid'=>''
         */

        //dd($event->user->getId());
        $userinfo = $this->officialAccount()->user->get($event->user->getId());
        $userinfo['appid'] = $this->officialAccount()->config->get('app_id');
        $service = new OfficialAccountService();
        $user = $service->register($userinfo);
        Auth::loginUsingId($user->uid);
        session(['wechat_user' => $userinfo]);
    }
}

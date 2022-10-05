<?php

namespace App\Listeners\Auth;


use App\Services\WechatService;
use App\Traits\WeChat\WechatDefaultConfig;
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

        //dd($event->getUser());
        //dd($event->user->getId());
        $userInfo = $event->user->getOriginal();
        session(['wechat_oauth_user' => $userInfo]);

        //dd($userInfo);
        $service = new WechatService();
        $user = $service->register([
            'appid' => $this->officialAccount($event->account)->config->get('app_id'),
            'openid' => $userInfo['openid'] ?? '',
            'unionid' => $userInfo['unionid'] ?? '',
            'nickname' => $userInfo['nickname'] ?? '',
            'gender' => $userInfo['sex'] ?? '',
            'country' => $userInfo['country'] ?? '',
            'province' => $userInfo['province'] ?? '',
            'city' => $userInfo['city'] ?? '',
            'avatar' => $userInfo['headimgurl'] ?? '',
        ]);
        Auth::loginUsingId($user->uid);
    }
}

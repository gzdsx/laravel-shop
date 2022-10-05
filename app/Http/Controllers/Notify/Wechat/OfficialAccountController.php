<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Services\WechatService;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\WechatServerMessage;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use Illuminate\Http\Request;

class OfficialAccountController extends Controller
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function server(Request $request)
    {
        $app = $this->officialAccount();
        $app->server->push(function ($message) use ($app) {
            $msg = new WechatServerMessage($message);
            if ($msg->event() == 'subscribe') {
                $user = $app->user->get($msg->fromUserName());
                $this->register($user);
            }
            return $this->wellComeMsg();
        });

        return $app->server->serve();
    }

    /**
     * @return News
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function wellComeMsg()
    {
        $newsitem = new NewsItem([
            'title' => setting('wechat_subscribe_msg_title'),
            'description' => setting('wechat_subscribe_msg_text'),
            'image' => image_url(setting('wechat_subscribe_msg_img')),
            'url' => setting('wechat_subscribe_msg_url')
        ]);
        return new News([$newsitem]);
    }

    /**
     * @param array $user
     */
    protected function register(array $user)
    {
        $service = new WechatService();
        $service->register([
            'openid' => $user['openid'] ?? '',
            'unionid' => $user['unionid'] ?? '',
            'nickname' => $user['nickname'] ?? '',
            'gender' => $user['sex'] ?? '',
            'city' => $user['city'] ?? '',
            'province' => $user['province'] ?? '',
            'country' => $user['country'] ?? '',
            'avatar' => $user['headimgurl'] ?? '',
            'appid' => $this->officialAccount()->config->get('app_id')
        ]);
    }
}

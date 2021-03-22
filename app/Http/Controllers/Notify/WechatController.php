<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Traits\WeChat\WechatDefaultConfig;
use EasyWeChat\Kernel\Messages\Message;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Support\XML;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    use WechatDefaultConfig;

    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

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
            return $this->wellComeMsg();
        }, Message::EVENT);
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
}

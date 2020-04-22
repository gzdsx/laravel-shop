<?php

namespace App\Http\Controllers\Notify;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Wechat\OfficialAccountService;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\WechatServerMessage;
use EasyWeChat\Kernel\Messages\Article;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Media;
use EasyWeChat\Kernel\Messages\Message;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WechatServerController extends Controller
{
    use WechatDefaultConfig;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function index(Request $request)
    {
        $app = $this->officialAccount();
        $app->server->push(function ($message) use ($app) {
            //Storage::put('server.php', json_encode($message));

//            $msg = new WechatServerMessage($message);
//            $user = $this->getUser($msg->getFromUserName());
//            if (Str::is('inviter:*', $msg->getEventKey())) {
//                $uid = str_replace('inviter:', '', $msg->getEventKey());
//                if ($uid) {
//                    $this->bindUser($uid, $user);
//                    //return $this->sendCustomMessage($uid);
//                    //return $this->sendTemplateMessage($msg->getFromUserName(), $user);
//                }
//            }
//
//            if ($msg->getEvent() == 'subscribe') {
//                if (Str::is('qrscene_inviter:*', $msg->getEventKey())) {
//                    $uid = str_replace('qrscene_inviter:', '', $msg->getEventKey());
//                    if ($uid) {
//                        $this->bindUser($uid, $user);
//                        //return $this->sendCustomMessage($uid);
//                        //return $this->sendTemplateMessage($msg->getFromUserName(), $user);
//                    }
//                }
//            }

            return '欢迎关注大师兄';
        }, Message::EVENT);
        return $app->server->serve();
    }

    /**
     * 发送客服消息
     * @param $uid
     * @return News
     */
    protected function sendCustomMessage($uid)
    {
        $newsitem = new NewsItem([
            'title' => '欢迎关注知止之行!',
            'description' => '你的好友' . User::find($uid)->username . '邀请你关注知止之行赢好礼',
            'url' => 'https://mp.weixin.qq.com/s/bcC1MiOHuUimU2rgolXHaA',
            'image' => 'https://zzzx.songdewei.com/storage/thumb/2019/06/57xhS12TkHOrGYhdmqddRIlDtyylAUIGMCkJCXpZ.jpeg',
        ]);

        return new News([$newsitem]);
    }

    /**
     * @return News
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

<?php

namespace App\Http\Controllers\Notify;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Wechat\OfficialAccountService;
use App\WeChat\Message\WechatServerMessage;
use App\WeChat\WechatDefaultConfig;
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
    use XmlToArrayTrait;
    protected $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    use WechatDefaultConfig;

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
        //Storage::put('server.php', $request->getContent());
        $app = $this->officialAccount();
        $app->server->push(function ($message) use ($app) {
            $msg = new WechatServerMessage($message);
            $user = $this->getUser($msg->getFromUserName());
            if (Str::is('inviter:*', $msg->getEventKey())) {
                $uid = str_replace('inviter:', '', $msg->getEventKey());
                if ($uid) {
                    $this->bindUser($uid, $user);
                    //return $this->sendCustomMessage($uid);
                    //return $this->sendTemplateMessage($msg->getFromUserName(), $user);
                }
            }

            if ($msg->getEvent() == 'subscribe') {
                if (Str::is('qrscene_inviter:*', $msg->getEventKey())) {
                    $uid = str_replace('qrscene_inviter:', '', $msg->getEventKey());
                    if ($uid) {
                        $this->bindUser($uid, $user);
                        //return $this->sendCustomMessage($uid);
                        //return $this->sendTemplateMessage($msg->getFromUserName(), $user);
                    }
                }
            }

            return $this->wellComeMsg();
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
     * 发送模板消息
     * @param $touser
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    protected function sendTemplateMessage($touser, $user)
    {
        $this->officialAccount()->template_message->send([
            'touser' => $touser,
            'template_id' => 'EYP2oUwhpGaf1nJKPqV6PV8yUhlROZMa57CbZNQGcyY',
            'url' => 'http://weixin.qq.com/download',
            'miniprogram' => [
                'appid' => 'wx36eedae8e1787b34',
                'pagepath' => 'pages/index'
            ],
            'data' => [
                'first' => '欢迎来到知止之行',
                'keyword1' => $user->username,
                'keyword2' => Carbon::now(),
                'remark' => '请点击链接访问知止之行小程序'
            ]
        ]);
    }

    /**
     * @param $uid
     * @param $invitee
     */
    protected function bindUser($uid, $invitee)
    {
        if ($uid && $invitee) {
            if ($uid != $invitee->uid) {
                Invite::updateOrCreate(['uid' => $uid, 'invitee_uid' => $invitee->uid]);
            }
        }
    }

    /**
     * @param $openid
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model|mixed|null
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    protected function getUser($openid)
    {
        $service = new OfficialAccountService();
        $userinfo = $this->officialAccount()->user->get($openid);
        $userinfo['appid'] = $this->officialAccount()->config->get('app_id');
        return $service->register($userinfo);
    }

    /**
     * @return News
     */
    protected function wellComeMsg()
    {
        $newsitem = new NewsItem([
            'title' => '【买一送一】维C之冠饮料给您超大惊喜！',
            'description' => '这个呆萌的小家伙，号称自己是维C之冠，维C含量是柳橙的1.7倍，柑橘的5~10倍，柠檬的11~13倍，苹果的20~80倍，维E是樱桃的2倍，钙是香蕉的2.5倍，纤维是菠萝的1.7倍。',
            'image' => 'https://mmbiz.qpic.cn/mmbiz_png/tSloybfddSJxlUpOQ99B02qUCicUXwmWtmibaDPdxXsZ26DjMX8Bmqlqe4uuQ47IsJ4oxrtZibt7SfNow2cYlxfvQ/640?wx_fmt=png&tp=webp&wxfrom=5&wx_lazy=1&wx_co=1',
            'url' => 'https://mp.weixin.qq.com/s/XyRqvgK64gVK2dEZgVItew'
        ]);
        return new News([$newsitem]);
    }
}

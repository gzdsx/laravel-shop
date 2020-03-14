<?php

namespace App\Http\Controllers\Api;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Wechat\WechatAppService;
use App\Traits\Wechat\SyncWechatHeadImg;
use App\Traits\Wechat\WechatPayManagers;
use App\WeChat\Response\UnifiedOrderResponse;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WechatAppController extends BaseController
{

    use SyncWechatHeadImg, WechatPayManagers;

    protected $userRepository;
    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
    }

    /**
     * //    city: "六盘水"
     * //    country: "中国"
     * //    headimgurl: "http://thirdwx.qlogo.cn/mmopen/vi_32/B3EYOzbXa1JjSTiadNv1KR7WdvL7vzaBuibbZHc94WHBGloevEh0j1NX5NJQ6fVKaicwrjlR3UaqNLV8TkUibiciaWgQ/132"
     * //    language: "zh_CN"
     * //    nickname: "贵州大师兄"
     * //    openid: "o5e_o1XHBhr-BxIqsbGusMe6b0Xs"
     * //    privilege: []
     * //    province: "贵州"
     * //    return_code: 0
     * //    return_msg: "SUCCESS"
     * //    sex: 1
     * //    unionid: "oj0Got63sWfQiSzCuRhHgrvkgpXY"
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $code = $request->input('code');
        $session = $this->getAccessToken($code);

        $openid = $session['openid'];
        $access_token = $session['access_token'];

        $client = new Client();
        $res = $client->get("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN");
        $wechatUserInfo = json_decode($res->getBody()->getContents(), true);
        $wechatUserInfo['openid'] = $session['openid'] ?? null;
        $wechatUserInfo['unionid'] = $session['unionid'] ?? null;
        $wechatUserInfo['appid'] = $this->wechatApp()->config->get('app_id');

        $service = new WechatAppService();
        $user = $service->register($wechatUserInfo);

        $grant_type = $request->input('grant_type');
        if ($grant_type) {
            $client_id = $request->input('client_id');
            $access_token = $user->createToken(\Laravel\Passport\Client::find($client_id)->name)->accessToken;
            return ajaxReturn([
                'openid' => $openid,
                'access_token' => $access_token,
                'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
            ]);
        } else {
            return ajaxReturn([
                'api_token' => $user->api_token,
                'openid' => $openid,
                'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
            ]);
        }
    }

    /**
     * @param $code
     * @return mixed
     */
    private function getAccessToken($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . config('wechat.app.default.app_id') .
            '&secret=' . config('wechat.app.default.secret') . '&code=' . $code . '&grant_type=authorization_code';
        $client = new Client();
        $res = $client->get($url);
        return json_decode($res->getBody()->getContents(), true);
    }

    /**
     * @param Request $request
     * @param UnifiedOrderResponse $unifiedResponse
     * @param \EasyWeChat\Payment\Application $payment
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfigResponse(Request $request, UnifiedOrderResponse $unifiedResponse, $payment)
    {
        return ajaxReturn(['config' => $payment->jssdk->appConfig($unifiedResponse->prepayId())]);
    }
}

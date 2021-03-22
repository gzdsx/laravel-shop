<?php

namespace App\Http\Controllers\Api;

use App\Models\UserConnect;
use App\Services\WechatService;
use App\Traits\WeChat\WechatPayManagers;
use Illuminate\Http\Request;

class WeappController extends BaseController
{
    use WechatPayManagers;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function session(Request $request)
    {
        $code = $request->input('code');
        $appid = $request->input('appid');
        $session = $this->miniprogram($appid)->auth->session($code);
        if (isset($session['openid'])) {
            return jsonSuccess(['session' => $session]);
        } else {
            return jsonError($session['errcode'], $session['errmsg']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function signin(Request $request)
    {
        $user = null;
        $code = $request->input('code');
        $appid = $request->input('appid');
        $session = $this->miniprogram($appid)->auth->session($code);
        if (isset($session['openid'])) {
            $connect = UserConnect::firstOrNew(['openid' => $session['openid']]);
            $connect->appid = $this->miniProgram($appid)->config->get('app_id');
            $connect->platform = 'wechat';
            $connect->fill($session)->save();

            if (!$connect->user) {
                if (isset($session['unionid'])) {
                    $newConnect = UserConnect::whereUnionid($session['unionid'])->whereHas('user')->first();
                    if ($newConnect) $connect->user()->associate($newConnect->user);
                }
            }

            if ($connect->user) {
                $access_token = $connect->user->createToken($appid, ['*'])->accessToken;
                $session['access_token'] = $access_token;
            }
            return jsonSuccess(['session' => $session]);
        } else {
            return jsonError($session['errcode'], $session['errmsg']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $service = new WechatService();
        $user = $service->register($request->input('wechatUserInfo', []));
        return jsonSuccess(['access_token' => $user->createToken($user->uid)->accessToken]);
    }
}

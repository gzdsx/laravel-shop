<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserConnect;
use App\Models\WechatSession;
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
        $appid = $request->input('appid', 'default');
        $session = $this->miniprogram($appid)->auth->session($code);
        if (isset($session['openid'])) {
            $wsession = WechatSession::firstOrNew(['openid' => $session['openid']]);
            $wsession->fill($session)->save();

            $result = $wsession->only('openid', 'unionid');
            $connect = UserConnect::whereHas('user')->where('openid', $wsession->openid)->first();
            if ($connect) {
                $result['access_token'] = $connect->user->createToken('weapp', ['*'])->accessToken;
            }

            return jsonSuccess($result);
        }

        return jsonError($session['errcode'], $session['errmsg']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\DecryptException
     */
    public function login(Request $request)
    {
        $iv = $request->input('iv');
        $encryptedData = $request->input('encryptedData');
        $openid = $request->input('openid');
        $appid = $request->input('appid', 'default');
        if ($session = WechatSession::whereOpenid($openid)->first()) {
            $app = $this->miniProgram($appid);
            $decrypt = $app->encryptor->decryptData($session->session_key, $iv, $encryptedData);
            $phoneNumber = $decrypt['phoneNumber'] ?? '';
            if ($user = User::whereMobile($phoneNumber)->first()) {
                $connect = UserConnect::firstOrNew(['openid' => $session->openid]);
                $connect->unionid = $session->unionid;
                $connect->appid = $app->config->get('app_id');
                $connect->platform = 'wechat';
                $connect->user()->associate($user);
                $connect->save();

                return jsonSuccess(['access_token' => $user->createToken('weapp', ['*'])->accessToken]);
            }

            return jsonSuccess(['phoneNumber' => $phoneNumber]);
        }

        return jsonError(403, 'openid invalid');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $openid = $request->input('openid');
        $mobile = $request->input('mobile');
        $userInfo = $request->input('userInfo', []);
        $appid = $request->input('appid', 'default');

        if ($session = WechatSession::whereOpenid($openid)->first()) {
            $newUserInfo = [
                'openid' => $session->openid,
                'unionid' => $session->unionid,
                'avatar' => $userInfo['avatarUrl'] ?? '',
                'city' => $userInfo['city'] ?? '',
                'province' => $userInfo['province'] ?? '',
                'country' => $userInfo['country'] ?? '',
                'gender' => $userInfo['gender'] ?? 1,
                'nickname' => $userInfo['nickName'] ?? '',
                'appid' => $this->miniProgram($appid)->config->get('app_id')
            ];
            $service = new WechatService();
            $user = $service->register($newUserInfo);

            if (!User::whereMobile($mobile)->exists()) {
                $user->mobile = $mobile;
                $user->save();
            }

            return jsonSuccess(['access_token' => $user->createToken('weapp', ['*'])->accessToken]);
        }

        return jsonError(403, 'openid invalid');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\DecryptException
     */
    public function getPhoneNumber(Request $request)
    {
        $openid = $request->input('openid');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');

        $session = WechatSession::whereOpenid($openid)->first();
        $result = $this->miniProgram()->encryptor->decryptData($session->session_key, $iv, $encryptedData);
        return jsonSuccess($result);
    }

    /**
     * 解密数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\DecryptException
     */
    public function decrypt(Request $request)
    {
        $iv = $request->input('iv');
        $encryptedData = $request->input('encryptedData');
        $openid = $request->input('openid');

        $session = WechatSession::whereOpenid($openid)->first();
        $result = $this->miniProgram()->encryptor->decryptData($session->session_key, $iv, $encryptedData);
        return jsonSuccess(['result' => $result]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\DecryptException
     */
    protected function registerWithPhone(Request $request)
    {
        $openid = $request->input('openid');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');

        $session = WechatSession::whereOpenid($openid)->first();
        $res = $this->miniProgram()->encryptor->decryptData($session->session_key, $iv, $encryptedData);
        if ($user = User::whereMobile($res['phoneNumber'])->first()) {
            $connect = UserConnect::firstOrNew(['openid' => $openid]);
            $connect->user()->associate($user);
            $connect->save();

            return jsonSuccess(['access_token' => $user->createToken('weapp', ['*'])->accessToken]);
        }
        return jsonSuccess($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registerWithUserInfo(Request $request)
    {
        $appid = $request->input('appid', 'default');
        $userInfo = $request->input('userInfo', []);
        if (!isset($userInfo['openid'])) {
            return jsonError(403, 'missing openid value');
        }

        $app = $this->miniProgram($appid);
        $service = new WechatService();
        $user = $service->register([
            'openid' => $userInfo['openid'],
            'unionid' => $userInfo['unionid'] ?? '',
            'avatar' => $userInfo['avatarUrl'] ?? '',
            'city' => $userInfo['city'] ?? '',
            'province' => $userInfo['province'] ?? '',
            'country' => $userInfo['country'] ?? '',
            'gender' => $userInfo['gender'] ?? 1,
            'nickname' => $userInfo['nickName'] ?? '',
            'appid' => $app->config->get('app_id')
        ]);
        return jsonSuccess(['access_token' => $user->createToken($user->uid)->accessToken]);
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Models\UserConnect;
use App\Models\WechatLogin;
use App\Models\WechatSession;
use App\Services\WechatService;
use App\Traits\WeChat\WechatDefaultConfig;
use EasyWeChat\Kernel\Exceptions\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MiniProgramController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function session(Request $request)
    {
        $code = $request->input('code');
        $session = $this->miniprogram()->auth->session($code);
        if (isset($session['openid'])) {
            $wsession = WechatSession::firstOrNew(['openid' => $session['openid']]);
            $wsession->fill($session)->save();

            $result = $wsession->only('openid', 'unionid');
            $connect = UserConnect::where('openid', $wsession->openid)->first();
            if ($connect->user) {
                $result['access_token'] = $connect->user->createToken('weapp', ['*'])->accessToken;
            } else {
                $connect->delete();
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
        $openid = $request->input('openid');
        $encryptedData = $request->input('encryptedData');

        $appid = $request->input('appid', 'default');
        if ($session = WechatSession::whereOpenid($openid)->first()) {
            $app = $this->miniProgram($appid);
            try {
                $decrypt = $app->encryptor->decryptData($session->session_key, $iv, $encryptedData);
                $phoneNumber = $decrypt['phoneNumber'] ?? '';
                if ($user = User::wherePhone($phoneNumber)->first()) {
                    return jsonSuccess(['access_token' => $user->createToken('weapp', ['*'])->accessToken]);
                } else {
                    $user = new User();
                    $user->nickname = $phoneNumber;
                    $user->phone = $phoneNumber;
                    $user->save();

                    $connect = new UserConnect();
                    $connect->openid = $openid;
                    $connect->user()->associate($user);
                    $connect->save();

                    return jsonSuccess(['access_token' => $user->createToken('weapp', ['*'])->accessToken]);
                }
            } catch (DecryptException $exception) {
                return jsonError(500, $exception->getMessage());
            }
        }

        return jsonError(500, 'openid invalid');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $openid = $request->input('openid');
        $userInfo = $request->input('userInfo', []);

        if ($session = WechatSession::whereOpenid($openid)->first()) {
            $user = new User();
            $user->phone = $request->input('phone');
            $user->nickname = $userInfo['nickName'] ?? '';
            $user->avatar = $userInfo['avatarUrl'] ?? '';
            $user->save();
            $user->refresh();

            $connect = UserConnect::firstOrNew(['openid' => $session->openid]);
            $connect->fill([
                'city' => $userInfo['city'] ?? '',
                'province' => $userInfo['province'] ?? '',
                'country' => $userInfo['country'] ?? '',
                'gender' => $userInfo['gender'] ?? 1,
                'nickname' => $userInfo['nickName'] ?? '',
                'avatar' => $userInfo['avatarUrl'] ?? '',
            ]);
            $connect->unionid = $session->unionid;
            $connect->platform = 'wechat';
            $connect->user()->associate($user);
            $connect->save();

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
        return jsonSuccess($result);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmLogin(Request $request)
    {
        $basestr = $request->input('basestr');
        $login = WechatLogin::where('basestr', $basestr)->first();
        if ($login) {
            $login->user()->associate(Auth::id());
            $login->save();
        }

        return jsonSuccess();
    }
}

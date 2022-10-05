<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserConnect;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class OfficialAccountController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $app = $this->officialAccount();
        $ouser = $app->oauth->user();
        $openid = $ouser->getId();
        $original = $ouser->getOriginal();

        $connect = UserConnect::where('openid', $openid)->firstOrNew();
        $connect->openid = $openid;
        $connect->unionid = $original['unionid'] ?? '';
        $connect->nickname = $ouser->getNickname();
        $connect->avatar = $ouser->getAvatar();
        $connect->gender = $original['sex'] ?? 1;
        $connect->province = $original['province'] ?? '';
        $connect->country = $original['country'] ?? '';
        $connect->save();

        if ($connect->user) {
            $user = $connect->user;
            $user->username = $ouser->getNickname();
            $user->avatar = $ouser->getAvatar();
            $user->save();

        } else {
            if (isset($original['unionid'])) {
                if ($connect = UserConnect::where('unionid', $original['unionid'])->whereHas('user')->first()) {
                    $user = $connect->user;
                } else {
                    $user = new User();
                }
            } else {
                $user = new User();
            }
            $user->username = $ouser->getNickname();
            $user->avatar = $ouser->getAvatar();
            $user->save();

            $user->profile->gender = $original['sex'] ?? 1;
            $user->profile->country = $original['country'] ?? '';
            $user->profile->province = $original['province'] ?? '';
            $user->profile->save();

            $connect->user()->associate($user);
            $connect->save();
        }

        $access_token = $user->createToken('official')->accessToken;

        return jsonSuccess([
            'openid' => $openid,
            'access_token' => $access_token
        ]);
    }
}

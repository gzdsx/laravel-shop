<?php

namespace App\Http\Controllers\Api\OAuth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    public function verCodeLogin(Request $request)
    {
        $code = $request->input('code');
        $phone = $request->input('phone');

        if ($verify = UserVerify::wherePhone($phone)->orderByDesc('id')->first()) {
            if ($code == $verify->code) {
                if (!$user = User::wherePhone($phone)->first()) {
                    $user = new User();
                    $user->phone = $phone;
                    $user->save();
                }

                return jsonSuccess([
                    'access_token' => $user->createToken('weapp', ['*'])->accessToken,
                    'user' => $user
                ]);
            }
        }

        return jsonError(500, '验证码错误');
    }
}

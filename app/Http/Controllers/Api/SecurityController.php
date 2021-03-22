<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'bail|required|string|pwd'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateMobile(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'bail|required|string|mobile',
            'code' => 'bail|required|string'
        ]);

        $mobile = $request->input('mobile');
        $verify = Verify::where('phone', $mobile)->orderByDesc('id')->first();
        if ($verify->code != $request->input('code')) {
            abort(500, '验证码错误');
        }

        $user = Auth::user();
        if ($user->mobile != $mobile) {
            if (User::query()->where('mobile', $mobile)->exists()) {
                abort(422, trans('user.mobile has been taken'));
            }
        }
        $user->mobile = $mobile;
        $user->save();

        $verify->delete();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|string|email'
        ]);

        $user = Auth::user();
        $email = $request->input('email');
        if ($user->email != $email) {
            if (User::query()->where('email', $email)->exists()) {
                abort(422, trans('user.email has been taken'));
            }
        }
        $user->email = $email;
        $user->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePaymentPwd(Request $request)
    {
        $this->validate($request, [
            'password' => 'bail|required|string|pwd'
        ]);

        $account = Auth::user()->account;
        $account->password = bcrypt($request->input('password'));
        $account->save();

        return jsonSuccess();
    }
}

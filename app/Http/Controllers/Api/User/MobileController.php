<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function bind(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'bail|required|string|mobile',
            'code' => 'bail|required|string'
        ]);

        $mobile = $request->input('mobile');
        $verify = UserVerify::where('phone', $mobile)->orderByDesc('id')->first();
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
    public function rebind(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'bail|required|string|mobile',
            'code' => 'bail|required|string'
        ]);

        $mobile = $request->input('mobile');
        $verify = UserVerify::where('phone', $mobile)->orderByDesc('id')->first();
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
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function bind(Request $request)
    {
        $this->validate($request, [
            'phone' => 'bail|required|string|phone',
            //'code' => 'bail|required|string'
        ]);

        $phone = $request->input('phone');
        $verify = UserVerify::where('phone', $phone)->orderByDesc('id')->first();
//        if ($verify->code != $request->input('code')) {
//            abort(600, '验证码错误');
//        }

        $user = Auth::user();
        if ($user->phone != $phone) {
            if (User::query()->where('phone', $phone)->exists()) {
                abort(600, trans('user.mobile has been taken'));
            }
        }
        $user->phone = $phone;
        $user->save();

        if ($verify) {
            $verify->delete();
        }

        return jsonSuccess();
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return jsonSuccess([
            'uid' => $user->uid,
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            'phone' => $user->phone,
            'email' => $user->email,
            'fullname' => $profile->fullname,
            'gender' => $profile->gender,
            'province' => $profile->province,
            'city' => $profile->city,
            'district' => $profile->district,
            'birthday' => $profile->birthday,
            'group' => $user->group
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(Request $request)
    {
        $model = Auth::user();
        $model->avatar = $request->input('avatar');
        $model->save();

        return jsonSuccess($model->avatar);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateName(Request $request)
    {
        $name = $request->input('name');
        $model = Auth::user();

        if ($name != $model->name) {
            $model->name = $name;
            $model->save();
        }

        return jsonSuccess($name);
    }
}

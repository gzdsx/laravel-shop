<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Api\BaseController;
use App\Models\UserFans;
use App\Traits\User\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends BaseController
{

    use UserTrait;

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


    public function getList(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(Request $request)
    {
        $fans = UserFans::firstOrCreate([
            'uid' => $request->input('uid'),
            'fans_id' => Auth::id()
        ]);

        return jsonSuccess(['fans' => $fans]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollow(Request $request)
    {
        $fans = UserFans::where([
            'uid' => $request->input('uid'),
            'fans_id' => Auth::id()
        ])->first();

        if ($fans) {
            $fans->delete();
        }

        return jsonSuccess();
    }
}

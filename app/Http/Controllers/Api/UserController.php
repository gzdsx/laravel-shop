<?php

namespace App\Http\Controllers\Api;


use App\Traits\User\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends BaseController
{

    use UserTrait;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return jsonSuccess(['userinfo' => [
            'uid' => $user->uid,
            'username' => $user->username,
            'avatar' => $user->avatar,
            'mobile' => $user->mobile,
            'email' => $user->email,
            'gender' => $profile->gender,
            'province' => $profile->province,
            'city' => $profile->city,
            'district' => $profile->district
        ]]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(Request $request)
    {
        $image = Image::make($request->input('avatar'));

        $x = 0;
        $y = 0;
        if ($image->width() > $image->height()) {
            $size = $image->height();
            $x = intval(($image->width() - $size) / 2);
        } else {
            $size = $image->width();
            $y = intval(($image->height() - $size) / 2);
        }
        $image->crop($size, $size, $x, $y);
        $image->resize($size, $size);

        $filePath = 'avatar/' . Str::random(40) . '.jpg';
        $image->save(material_path($filePath));

        $user = Auth::user();
        $user->avatar = material_url($filePath);
        $user->save();

        return jsonSuccess(['avatar' => $user->avatar]);
    }
}

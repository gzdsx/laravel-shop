<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request)
    {
        $userinfo = Auth::user()->info()->firstOrCreate([]);
        return ajaxReturn(['userinfo' => $userinfo]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateInfo(Request $request){
        $userinfo = Auth::user()->info()->firstOrCreate([]);
        $userinfo->fill($request->input('userinfo',[]))->save();
        return ajaxReturn(['userinfo' => $userinfo]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(Request $request){
        ignore_user_abort(true);
        $user = Auth::user();
        $avatarPath = material_path('avatar/' . $user->uid);
        @mkdir($avatarPath, 0777, true);
        $source = material_path(strip_image_url($request->input('image')));

        $image = Image::make($source);
        $width = $image->width();
        $height = $image->height();
        if ($width > $height) {
            $x = ($width - $height) / 2;
            $image = $image->crop($height, $height, intval($x), 0);
        } else {
            $y = ($height - $width) / 2;
            $image = $image->crop($width, $width, 0, intval($y));
        }

        $image->resize(300, 300)->save($avatarPath . '/big.png');
        $image->resize(150, 150)->save($avatarPath . '/middle.png');
        $image->resize(50, 50)->save($avatarPath . '/small.png');

        return ajaxReturn();
    }
}

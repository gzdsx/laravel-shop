<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        $user = Auth::user();
        $userinfo = array_merge(
            $user->only('uid', 'gid', 'username', 'mobile', 'email', 'avatar'),
            $user->info->only(['gender', 'province', 'city', 'district'])
        );
        return ajaxReturn(['userinfo' => $userinfo]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $info = $request->input('info');
        if ($info) {
            $info['updated_at'] = time();
            Auth::user()->info()->update($info);
        }

        $user = $request->input('user');
        if ($user) {
            Auth::user()->update($user);
        }
        return ajaxReturn();
    }

    public function avatar(Request $request)
    {
        $file = $request->file('file');

        if ($file->getExtension() == 'jpg' || $file->getExtension() == 'jpeg') {
            removeExif($file->getRealPath());
        }
        $img = Image::make($file->getRealPath());

        $x = $y = $w = $h = 0;

        $width = $img->getWidth();
        $height = $img->getHeight();
        if ($width > $height) {
            $x = intval(($width - $height) / 2);
            $y = 0;
            $w = $height;
            $h = $height;
        } else {
            $x = 0;
            $y = intval(($height - $width) / 2);
            $w = $width;
            $h = $width;
        }

        $avatarDir = material_path('avatar/' . $this->uid);
        $img->crop($w, $h, $x, $y)->resize(300, 300)->save($avatarDir . '/big.png')
            ->resize(150, 150)->save($avatarDir . '/middle.png')
            ->resize(50, 50)->save($avatarDir . '/small.png');
        return ajaxReturn(['avatar' => avatar($this->uid) . '?' . time()]);
    }
}

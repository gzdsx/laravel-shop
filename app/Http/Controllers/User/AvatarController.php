<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvatarController extends Controller
{
    /**
     * @param Request $request
     * @param $code
     * @return mixed
     */
    public function index(Request $request, $code){
        $data = unserialize(base64_decode($code));
        $uid  = $data['uid'];
        $size = $data['size'];
        $size = in_array($size, array('middel','small')) ? $size : 'big';
        $avatar = material_path('avatar/'.$uid.'/'.$size.'.png');

        if (!is_file($avatar)) {
            $avatar = public_path('/images/common/avatar_default.png');
        }

        return response()->file($avatar);
    }
}

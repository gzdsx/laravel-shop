<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset(Request $request)
    {
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $user = Auth::user();
        if (!Hash::check($oldpassword, $user->getAuthPassword())) {
            return jsonError(600, trans('user.old password input incorrect'));
        }
        $user->password = bcrypt($newpassword);
        $user->save();

        return jsonSuccess();
    }
}

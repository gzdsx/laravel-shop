<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SecurityController extends BaseController
{
    public function updateMobile(Request $request){
        $validate = Validator::make($request->all(), [
            'mobile' => 'bail|required|string|mobile|unique:user'
        ]);

        if ($validate->fails()) {
            if ($msg = $validate->errors()->first()){
                abort(422, $msg);
            }
        }

        Auth::user()->fill($request->only('mobile'))->save();
        Auth::loginUsingId(Auth::id(), true);
        return jsonSuccess();
    }

    public function updateEmail(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'bail|required|string|email|unique:user'
        ]);

        if ($validate->fails()) {
            if ($msg = $validate->errors()->first()){
                abort(422, $msg);
            }
        }

        Auth::user()->fill($request->only(['email']))->save();
        Auth::loginUsingId(Auth::id(), true);
        return jsonSuccess();
    }

    public function updatePassword(Request $request){
        $validate = Validator::make($request->all(), [
            'password' => 'bail|required|string|pwd',
            'newpassword' => 'bail|required|string|pwd',
        ]);

        if ($validate->fails()) {
            if ($msg = $validate->errors()->first()){
                abort(422, $msg);
            }
        }

        $user = Auth::user();
        $oldpassword = $request->input('password');
        $newpassword = $request->input('newpassword');
        if (Hash::check($oldpassword, $user->getAuthPassword())) {
            $user->update(['password' => Hash::make($newpassword)]);
            return jsonSuccess();
        } else {
            return jsonError(422, trans('user.old password input incorrect'));
        }
    }
}

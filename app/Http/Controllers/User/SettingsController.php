<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SettingsController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userinfo(Request $request)
    {
        $updated = $request->session()->get('updated');
        if ($updated) $request->session()->forget('updated');

        return $this->view('user.settings.userinfo', [
            'menu' => 'userinfo',
            'userinfo' => $request->user()->info,
            'sex_items' => trans('user.sex_items'),
            'updated' => $updated
        ]);
    }

    public function saveInfo(Request $request)
    {
        $userinfo = $request->post('userinfo');
        $request->user()->info()->update($userinfo);
        $request->session()->put('updated', 'true');
        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function security()
    {
        $this->assign([
            'menu' => 'security',
            'user' => $this->request->user(),
        ]);

        return $this->view('user.settings.security');
    }

    public function bindMobile()
    {
        $validate = Validator::make($this->request->all(), [
            'mobile' => 'bail|required|string|mobile|unique:user',
            'captcha' => 'bail|required|string|captcha'
        ]);

        if ($validate->fails()) {
            foreach ($validate->errors()->getMessages() as $messages) {
                foreach ($messages as $msg) {
                    return ajaxError(422, $msg);
                }
            }
        }

        $mobile = $this->request->input('mobile');
        $this->request->user()->update(['mobile' => $mobile, 'updated_at' => time()]);
        Auth::loginUsingId($this->uid);
        return ajaxReturn();
    }

    public function bindEmail()
    {
        $validate = Validator::make($this->request->all(), [
            'email' => 'bail|required|string|email|unique:user',
            'captcha' => 'bail|required|string|captcha'
        ]);

        if ($validate->fails()) {
            foreach ($validate->errors()->getMessages() as $messages) {
                foreach ($messages as $msg) {
                    return ajaxError(422, $msg);
                }
            }
        }

        $email = $this->request->input('email');
        $this->request->user()->update(['email' => $email, 'updated_at' => time()]);
        Auth::loginUsingId($this->uid);
        return ajaxReturn();
    }

    public function resetPassword()
    {
        $validate = Validator::make($this->request->all(), [
            'oldpassword' => 'bail|required|string|password',
            'newpassword' => 'bail|required|string|password',
            'captcha' => 'bail|required|string|captcha'
        ]);

        if ($validate->fails()) {
            foreach ($validate->errors()->getMessages() as $messages) {
                foreach ($messages as $msg) {
                    return ajaxError(422, $msg);
                }
            }
        }

        $user = Auth::user();
        $oldpassword = $this->request->post('oldpassword');
        $newpassword = $this->request->post('newpassword');
        if (Hash::check($oldpassword, $user->getAuthPassword())) {
            $user->update([
                'password' => Hash::make($newpassword),
                'updated_at' => time()
            ]);
            return ajaxReturn();
        } else {
            return ajaxError(422, trans('user.old password input incorrect'));
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar()
    {

        ignore_user_abort(true);
        $avatarPath = material_path('avatar/' . $this->uid);
        @mkdir($avatarPath, 0777, true);
        $source = material_path($this->request->file('file')->store('tmp'));

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
        @unlink($source);

        return ajaxReturn();
    }
}

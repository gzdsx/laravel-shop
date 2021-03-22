<?php

namespace App\Http\Controllers\H5;


use App\Models\WechatLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $basestr = $request->input('basestr');
        $wxlogin = WechatLogin::where('basestr', $basestr)->first();
        if (!$wxlogin) {
            return $this->messager()->setType('error')->setMessage('二维码已过期，请刷新后重新扫码')->render();
        }
        return $this->view('h5.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $basestr = $request->input('basestr');
        $wxlogin = WechatLogin::where('basestr', $basestr)->first();
        if ($wxlogin) {
            $wxlogin->update(['uid' => Auth::id(), 'openid' => session('openid')]);
        }
        return $this->messager()->setMessage('登录成功')->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cancel(Request $request)
    {
        return $this->messager()->setType('error')->setMessage('已取消登录')->render();
    }
}

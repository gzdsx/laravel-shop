<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/1/20
 * Time: 05:26
 */

namespace App\Traits\Auth;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

trait UserLogin
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'account';
    }

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|account',
            'password' => 'required|string|pwd',
        ]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');

        $emailLogin = $this->guard()->attempt([
            'email' => $account,
            'password' => $password
        ], $request->filled('remember'));

        if ($emailLogin) {
            return true;
        }

        $mobileLogin = $this->guard()->attempt([
            'phone' => $account,
            'password' => $password
        ], $request->filled('remember'));

        if ($mobileLogin) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @param $user
     * @return string
     */
    public function authenticated(Request $request, $user)
    {
        if ($redirect = session('redirect')) {
            session()->forget('redirect');
            return redirect()->to($redirect);
        } else {
            return redirect()->to($this->redirectPath());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loggedOut(Request $request)
    {
        if ($redirect = $request->input('redirect')) {
            return redirect()->to($redirect);
        } else {
            return redirect()->to(url()->previous());
        }
    }
}

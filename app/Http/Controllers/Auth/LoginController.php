<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|account',
            'password' => 'required|string|pwd',
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authenticated(Request $request, $user)
    {
        event(new UserEvent($user, 'loggedin'));
        $redirect = $request->input('redirect');
        if ($redirect) {
            return redirect($redirect);
        } else {
            return redirect()->intended();
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        $account  = $request->input('account');
        $password = $request->input('password');

        $emailLogin = $this->guard()->attempt([
            'email'=>$account,
            'password'=>$password
        ], $request->has('remember'));

        if ($emailLogin) {
            return true;
        }

        $mobileLogin = $this->guard()->attempt([
            'mobile'=>$account,
            'password'=>$password
        ], $request->has('remember'));

        if ($mobileLogin) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loggedOut(Request $request)
    {
        $redirect = $request->input('redirect');
        if ($redirect) {
            return redirect($redirect);
        } else {
            return redirect()->intended();
        }
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'account';
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        $redirect = \request()->input('redirect');
        if ($redirect) {
            return $redirect;
        } else {
            return redirect()->intended()->getTargetUrl();
        }
    }
}

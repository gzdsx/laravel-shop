<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * LoginController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function (Request $req, $next){
            if (Auth::check()){
                if (Auth::user()->uid == session()->get('adminid')){
                    return redirect()->to($this->redirectPath());
                }
            }
            return $next($req);
        })->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function redirectPath()
    {
        return admin_url();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm()
    {

        return $this->view('admin.login');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'bail|required|string|account',
            'password' => 'bail|required|string|pwd'
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticated(Request $request, $user)
    {
        session()->put('adminid', $user->uid);
        event(new UserEvent($user, 'loggedin'));
        $redirect = $request->input('redirect');
        if ($redirect){
            return redirect()->to($redirect);
        }
        return redirect()->to($this->redirectPath());
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');

        $mobileLogin = $this->guard()->attempt([
            'mobile' => $account,
            'password' => $password,
            'admincp' => 1
        ], true);

        if ($mobileLogin) {
            return true;
        }

        $emailLogin = $this->guard()->attempt([
            'email' => $account,
            'password' => $password,
            'admincp' => 1
        ], true);

        if ($emailLogin) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loggedOut(Request $request)
    {
        return redirect()->intended(admin_url('login'));
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'account';
    }
}

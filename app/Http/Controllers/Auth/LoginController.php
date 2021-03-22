<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Traits\Auth\UserLogin;
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

    use UserLogin;

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
    public function index(Request $request)
    {
        session(['redirect' => $request->input('redirect', url()->previous())]);
        return $this->view('auth.login');
    }
}

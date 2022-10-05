<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use App\Traits\Auth\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use UserLogin;

    /**
     * LoginController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function (Request $req, $next) {
            if (Auth::check()) {
                return redirect()->to(admin_url('/'));
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
    public function index(Request $request)
    {
        if ($redirect = $request->input('redirect')) {
            session(['redirect' => $redirect]);
        }
        return $this->view('admin.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loggedOut(Request $request)
    {
        return redirect()->to(admin_url('login'));
    }
}

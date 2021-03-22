<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Traits\Auth\UserLogin;
use Illuminate\Http\Request;

class SigninController extends BaseController
{
    use UserLogin;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return '/h5/user';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $redirect = $request->input('redirect', url()->previous());
        return $this->view('h5.auth.signin', compact('redirect'));
    }

    public function loggedOut(Request $request)
    {
        return redirect('/h5');
    }
}

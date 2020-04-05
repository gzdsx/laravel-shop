<?php

namespace App\Http\Controllers\H5;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SecurityController extends BaseController
{

    /**
     * SecurityController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('wechat.oauth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return $this->view('h5.security');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $password = $request->input('password');
        Auth::user()->fill(['password' => Hash::make($password)])->save();
        return ajaxReturn();
    }
}

<?php

namespace App\Http\Controllers\H5;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return $this->view('h5.user');
    }
}

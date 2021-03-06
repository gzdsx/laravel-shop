<?php

namespace App\Http\Controllers\H5;

use Illuminate\Http\Request;

class UserController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = auth()->check() ? auth()->user() : [];
        return $this->view('h5.user.index', compact('user'));
    }
}

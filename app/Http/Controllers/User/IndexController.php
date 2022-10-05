<?php

namespace App\Http\Controllers\User;


class IndexController extends BaseController
{
    public function index()
    {
        return $this->view('user.index');
    }
}

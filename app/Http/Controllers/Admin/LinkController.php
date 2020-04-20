<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return  $this->view('admin.link');
    }
}

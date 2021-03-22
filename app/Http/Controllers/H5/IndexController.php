<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        //dd(session()->all());
        //session()->forget('wechat');
        //session()->flush();
        return $this->view('h5.index');
    }
}

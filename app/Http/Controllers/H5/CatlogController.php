<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class CatlogController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.catlog');
    }
}

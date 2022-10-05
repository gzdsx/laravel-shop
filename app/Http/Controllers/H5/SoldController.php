<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class SoldController extends BaseController
{

    public function index(Request $request, $order_id)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        return $this->view('h5.sold.detail');
    }
}

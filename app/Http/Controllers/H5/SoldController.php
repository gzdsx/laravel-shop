<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class SoldController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('wechat.oauth');
    }

    /**
     * @param Request $request
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $order_id)
    {
        return $this->view('h5.sold', compact('order_id'));
    }
}

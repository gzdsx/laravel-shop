<?php

namespace App\Http\Controllers\H5;

use Illuminate\Http\Request;

class CartController extends BaseController
{

    /**
     * CartController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        if (!auth()->check()){
            //$this->middleware(['wechat.oauth']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.cart');
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Traits\Shop\CartTrait;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return $this->view('shop.cart.index');
    }
}

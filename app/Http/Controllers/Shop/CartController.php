<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Traits\Cart\CartTrait;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartTrait;

    public function index(Request $request){

        return $this->view('shop.cart.index');
    }
}

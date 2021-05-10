<?php

namespace App\Http\Controllers\Api\Shop;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Shop\CartTrait;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth:api');
    }
}

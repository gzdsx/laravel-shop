<?php

namespace App\Http\Controllers\Api;


use App\Traits\Cart\CartTrait;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartTrait;
}

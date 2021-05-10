<?php

namespace App\Http\Controllers\Api\Product;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Product\ProductTrait;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    use ProductTrait;
}

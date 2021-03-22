<?php

namespace App\Http\Controllers\Api;


use App\Traits\Product\ProductCollectTrait;
use Illuminate\Http\Request;

class ProductCollectController extends BaseController
{
    use ProductCollectTrait;
}

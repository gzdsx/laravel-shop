<?php

namespace App\Http\Controllers\Api\Product;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Product\ProductCollectTrait;
use Illuminate\Http\Request;

class CollectController extends BaseController
{
    use ProductCollectTrait;
}

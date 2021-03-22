<?php

namespace App\Http\Controllers\Api;


use App\Traits\Product\ProductCategoryTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{
    use ProductCategoryTrait;
}

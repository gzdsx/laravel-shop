<?php

namespace App\Http\Controllers\Api\Product;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Product\ProductCategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use ProductCategoryTrait;
}

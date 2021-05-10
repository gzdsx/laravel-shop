<?php

namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Admin\BaseController;
use App\Traits\Product\ProductCategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use ProductCategoryTrait;
}

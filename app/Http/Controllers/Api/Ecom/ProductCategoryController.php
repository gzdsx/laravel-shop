<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Ecom\ProductCategoryTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{
    use ProductCategoryTrait;
}

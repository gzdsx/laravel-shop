<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Ecom\ProductTrait;
use Illuminate\Http\Request;

class ProductItemController extends BaseController
{
    use ProductTrait;
}

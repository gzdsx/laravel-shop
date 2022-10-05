<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\Ecom\ProductAttrTrait;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    use ProductAttrTrait;
}

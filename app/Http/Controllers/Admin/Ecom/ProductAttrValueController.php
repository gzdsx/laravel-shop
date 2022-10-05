<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\Ecom\ProductAttrValueTrait;
use Illuminate\Http\Request;

class ProductAttrValueController extends BaseController
{
    use ProductAttrValueTrait;
}

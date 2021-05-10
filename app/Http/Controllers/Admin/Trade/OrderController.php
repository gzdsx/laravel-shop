<?php

namespace App\Http\Controllers\Admin\Trade;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Trade\SoldTrait;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use SoldTrait;
}

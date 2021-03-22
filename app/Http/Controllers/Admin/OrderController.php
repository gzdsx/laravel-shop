<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Order\SoldTrait;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use SoldTrait;
}

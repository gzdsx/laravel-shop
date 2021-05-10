<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Shop\RefundAddressTrait;
use Illuminate\Http\Request;

class RefundAddressController extends BaseController
{
    use RefundAddressTrait;
}

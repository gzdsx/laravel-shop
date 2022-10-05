<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Ecom\RefundAddressTrait;
use Illuminate\Http\Request;

class RefundAddressController extends BaseController
{
    use RefundAddressTrait;
}

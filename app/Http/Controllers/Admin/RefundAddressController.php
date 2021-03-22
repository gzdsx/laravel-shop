<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Shop\RefundAddressTrait;
use Illuminate\Http\Request;

class RefundAddressController extends BaseController
{
    use RefundAddressTrait;
}

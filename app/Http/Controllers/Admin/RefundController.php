<?php

namespace App\Http\Controllers\Admin;


use App\Traits\Order\RefundTrait;
use Illuminate\Http\Request;

class RefundController extends BaseController
{
    use RefundTrait;
}

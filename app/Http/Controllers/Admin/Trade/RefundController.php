<?php

namespace App\Http\Controllers\Admin\Trade;


use App\Http\Controllers\Admin\BaseController;
use App\Traits\Trade\RefundTrait;
use Illuminate\Http\Request;

class RefundController extends BaseController
{
    use RefundTrait;
}

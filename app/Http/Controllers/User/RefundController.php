<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\Order\RefundTrait;
use Illuminate\Http\Request;

class RefundController extends BaseController
{
    use RefundTrait;
}

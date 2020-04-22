<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Order\SoldTrait;
use Illuminate\Http\Request;

class SoldController extends BaseController
{
    use SoldTrait;
}

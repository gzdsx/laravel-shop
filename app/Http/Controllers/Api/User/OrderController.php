<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Trade\BoughtTrait;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use BoughtTrait;
}

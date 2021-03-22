<?php

namespace App\Http\Controllers\User;

use App\Traits\Order\BoughtTrait;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtTrait;
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Order\BoughtTrait;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtTrait;
}

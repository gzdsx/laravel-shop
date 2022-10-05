<?php

namespace App\Http\Controllers\Api\Trade;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\Trade\BoughtTrait;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtTrait;
}

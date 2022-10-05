<?php

namespace App\Http\Controllers\Admin\Lbs;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\Lbs\TMapTrait;
use Illuminate\Http\Request;

class LbsController extends BaseController
{
    use TMapTrait;
}

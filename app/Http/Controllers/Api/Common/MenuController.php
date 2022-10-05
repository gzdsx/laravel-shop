<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Common\MenuTrait;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use MenuTrait;
}

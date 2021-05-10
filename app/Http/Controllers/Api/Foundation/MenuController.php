<?php

namespace App\Http\Controllers\Api\Foundation;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Foundation\MenuTrait;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use MenuTrait;
}

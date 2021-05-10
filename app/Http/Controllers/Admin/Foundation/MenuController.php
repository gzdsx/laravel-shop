<?php

namespace App\Http\Controllers\Admin\Foundation;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Foundation\MenuTrait;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use MenuTrait;
}

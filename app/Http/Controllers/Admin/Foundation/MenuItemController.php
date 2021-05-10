<?php

namespace App\Http\Controllers\Admin\Foundation;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Foundation\MenuItemTrait;
use Illuminate\Http\Request;

class MenuItemController extends BaseController
{
    use MenuItemTrait;
}

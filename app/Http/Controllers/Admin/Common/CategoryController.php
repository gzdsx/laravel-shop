<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\Common\CategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use CategoryTrait;
}

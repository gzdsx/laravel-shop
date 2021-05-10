<?php

namespace App\Http\Controllers\Api\Foundation;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Foundation\BlockItemTrait;
use Illuminate\Http\Request;

class BlockItemController extends BaseController
{
    use BlockItemTrait;
}

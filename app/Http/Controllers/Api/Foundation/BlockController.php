<?php

namespace App\Http\Controllers\Api\Foundation;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Foundation\BlockTrait;
use Illuminate\Http\Request;

class BlockController extends BaseController
{
    use BlockTrait;
}

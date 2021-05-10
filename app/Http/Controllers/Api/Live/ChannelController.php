<?php

namespace App\Http\Controllers\Api\Live;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Live\LiveChannelTrait;
use Illuminate\Http\Request;

class ChannelController extends BaseController
{
    use LiveChannelTrait;
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Live\LiveChannelTrait;
use Illuminate\Http\Request;

class LiveChannelController extends BaseController
{
    use LiveChannelTrait;
}

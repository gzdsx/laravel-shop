<?php

namespace App\Http\Controllers\Admin\Live;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Live\LiveChannelTrait;
use Illuminate\Http\Request;

class ChannelController extends BaseController
{
    use LiveChannelTrait;
}

<?php

namespace App\Http\Controllers\Api\Video;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Video\VideoTrait;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    use VideoTrait;
}

<?php

namespace App\Http\Controllers\Admin\Video;


use App\Http\Controllers\Admin\BaseController;
use App\Models\Video;
use App\Traits\Video\VideoTrait;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    use VideoTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Video::query();
    }
}

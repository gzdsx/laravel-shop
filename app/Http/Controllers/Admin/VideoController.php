<?php

namespace App\Http\Controllers\Admin;


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
        return Video::withoutGlobalScopes();
    }
}

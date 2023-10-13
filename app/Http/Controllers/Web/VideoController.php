<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    protected $navName = 'video';

    public function index(Request $request)
    {
        $videos = Video::orderByDesc('id')->paginate();

        return $this->view('web.video-home',compact('videos'));
    }
}

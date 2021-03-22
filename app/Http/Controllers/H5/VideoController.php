<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.video.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->increment('views');
        $items = Video::orderByDesc('id')->limit(4)->get();

        return $this->view('h5.video.detail', compact('video', 'items'));
    }
}

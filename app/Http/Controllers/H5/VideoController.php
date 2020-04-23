<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    public function index(Request $request)
    {
        $items = Video::orderByDesc('id')->limit(20)->get();

        return $this->view('h5.video', compact('items'));
    }

    public function detail(Request $request, $id){
        $video = Video::findOrFail($id);
        $items = Video::orderByDesc('id')->limit(5)->get();

        return $this->view('h5.video_detail',compact('video','items'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    public function batchGet(Request $request){
        $items = Video::offset($request->input('offset',0))
            ->limit($request->input('count',15))
            ->orderByDesc('id')->get();
        return ajaxReturn(['items'=>$items]);
    }

    public function update(Request $request){
        $video = Video::findOrNew($request->input('id'));
        $video->fill($request->input('video',[]))->save();
        return ajaxReturn(['video'=>$video]);
    }

    public function delete(Request $request){
        Video::whereKey($request->input('items',[]))->delete();
        return ajaxReturn();
    }
}

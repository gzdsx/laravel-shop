<?php

namespace App\Http\Controllers\Notify\Live;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LiveController extends Controller
{

    /**
     * @param Request $request
     */
    public function onPublish(Request $request)
    {
        Storage::put('on_publish', json_encode($request->all()));
        Live::where('stream_id', $request->input('name'))->update(['state' => 1]);
    }

    /**
     * @param Request $request
     */
    public function onPublishDone(Request $request)
    {
        Storage::put('on_publish_done', json_encode($request->all()));
        Live::where('stream_id', $request->input('name'))->update(['state' => 2]);
    }
}

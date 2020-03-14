<?php

namespace App\Http\Controllers\Api;

use App\Models\PostCatlog;
use Illuminate\Http\Request;

class PostCatlogController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $catid = $request->input('catid', 0);
        return ajaxReturn(['catlog' => PostCatlog::find($catid)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $fid = $request->input('fid', 0);
        $items = PostCatlog::where('fid', $fid)->orderBy('displayorder')->get();
        return ajaxReturn(['items' => $items]);
    }
}

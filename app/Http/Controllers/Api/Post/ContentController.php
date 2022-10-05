<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PostContent;
use Illuminate\Http\Request;

class ContentController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $contents = PostContent::whereAid($request->input('aid'))->get();

        return jsonSuccess($contents);
    }
}

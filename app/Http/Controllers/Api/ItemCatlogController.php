<?php

namespace App\Http\Controllers\Api;

use App\Models\ItemCatlog;
use Illuminate\Http\Request;

class ItemCatlogController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $catid = $request->input('catid', 0);
        return ajaxReturn(['catlog' => ItemCatlog::find($catid)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $fid = $request->input('fid', 0);
        $items = ItemCatlog::where('fid', $fid)->orderBy('displayorder')->get();
        return ajaxReturn(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(Request $request)
    {
        return ajaxReturn(['items' => ItemCatlog::fetchWithCache()]);
    }
}

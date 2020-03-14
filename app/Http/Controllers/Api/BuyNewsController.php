<?php

namespace App\Http\Controllers\Api;

use App\Library\Other\BuyNewsManagers;
use App\Models\BuyNews;
use Illuminate\Http\Request;

class BuyNewsController extends BaseController
{
    use BuyNewsManagers;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $id = $request->input('id', 0);
        BuyNews::where('id', $id)->increment('views');
        $news = BuyNews::with('user')->find($id);

        return ajaxReturn(['news' => $news]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $items = BuyNews::with('user')->offset($offset)->limit($count)->orderByDesc('id')->get();
        return ajaxReturn(['items' => $items]);
    }
}

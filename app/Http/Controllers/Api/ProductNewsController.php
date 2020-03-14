<?php

namespace App\Http\Controllers\Api;


use App\Library\Other\ProductNewsManagers;
use App\Models\ProductNews;
use Illuminate\Http\Request;

class ProductNewsController extends BaseController
{
    use ProductNewsManagers;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $items = ProductNews::with('user')->orderByDesc('id')->offset($offset)->limit($count)->get();
        return ajaxReturn(['items' => $items]);
    }
}

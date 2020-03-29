<?php

namespace App\Http\Controllers\H5;

use App\Repositories\Contracts\ItemCatlogRepositoryInterface;
use Illuminate\Http\Request;

class CatlogController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $catlogs = app(ItemCatlogRepositoryInterface::class)->all();
        return $this->view('h5.catlog', compact('catlogs'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = app(ItemCatlogRepositoryInterface::class)->all();
        return ajaxReturn(['items' => $items]);
    }
}

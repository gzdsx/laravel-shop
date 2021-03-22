<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\BlockItem;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $slides = BlockItem::where('block_id', 1)->get();
        $items = ProductItem::orderByDesc('itemid')->limit(20)->get();
        return $this->view('shop.index', compact('slides', 'items'));
    }
}

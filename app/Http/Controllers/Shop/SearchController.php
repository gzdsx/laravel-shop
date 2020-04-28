<?php

namespace App\Http\Controllers\Shop;


use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function index(Request $request)
    {
        $items = Item::filter($request->all())->paginate();
        $pagination = $items->appends($request->except('page'))->render();
        $hotSales = Item::orderByDesc('sold')->limit(10)->get();
        return $this->view('shop.search', compact('items', 'pagination', 'hotSales'));
    }
}

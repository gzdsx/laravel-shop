<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    public function detail(Request $request, $itemid)
    {
        $item = Item::withoutGlobalScopes()->findOrFail($itemid);
        $hotSales = Item::orderByDesc('sold')->limit(5)->get();
        return $this->view('shop.item', compact('itemid', 'item', 'hotSales'));
    }
}

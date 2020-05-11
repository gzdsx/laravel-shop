<?php

namespace App\Http\Controllers\Shop;


use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ItemController extends BaseController
{
    /**
     * @param Request $request
     * @param $itemid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $itemid)
    {
        $item = Item::withoutGlobalScopes()->findOrFail($itemid);
        if ($item->on_sale == 0) {
            if (!Gate::allows('preview', $item)) {
                abort(404, __('item.this item has been removed'));
            }
        }
        $item->increment('views');
        $item->load(['content', 'user', 'images', 'skus', 'catlogs']);
        $hotSales = Item::orderByDesc('sold')->limit(5)->get();
        return $this->view('shop.item', compact('itemid', 'item', 'hotSales'));
    }
}

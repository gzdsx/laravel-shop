<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\BlockItem;
use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\PostItem;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {

        $catlogs = ItemCatlog::fetchWithCache();
        $slides = BlockItem::where('block_id', 1)->get();
        $news = PostItem::orderByDesc('aid')->limit(10)->get();
        $items = Item::orderByDesc('itemid')->get();
        return $this->view('shop.index', compact('catlogs', 'slides', 'news','items'));
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\EcomProductItem;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    protected $navName = 'shop';

    public function index(Request $request)
    {
        $products = EcomProductItem::query()->orderByDesc('itemid')->limit(15)->get();

        return $this->view('web.shop-home', compact('products'));
    }
}

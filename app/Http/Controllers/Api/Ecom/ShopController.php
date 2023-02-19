<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Controller;
use App\Models\EcomProductItem;
use App\Traits\Ecom\ShopTrait;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use ShopTrait;

    public function getShopItemCount(Request $request)
    {
        $result = EcomProductItem::whereShopId($request->input('shop_id'))->where('state', 1)->count();

        return jsonSuccess($result);
    }
}

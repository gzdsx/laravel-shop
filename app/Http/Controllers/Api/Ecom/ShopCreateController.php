<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Models\EcomShop;
use App\Models\EcomShopSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopCreateController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $shop = new EcomShop();
        $shop->fill($request->input('shop', []));
        $shop->seller()->associate(Auth::id());
        $shop->save();

        $session = EcomShopSession::firstOrCreate(['uid' => Auth::id()]);
        $session->shop()->associate($shop)->save();

        return jsonSuccess(['shop' => $shop]);
    }
}

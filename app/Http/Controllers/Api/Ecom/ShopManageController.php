<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Models\EcomShop;
use App\Models\EcomShopSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopManageController extends BaseController
{
    use HasEcomShopSession;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $shop = $this->shop();
        return json_success(['shop' => $shop]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $items = EcomShop::with(['certify'])->whereSellerId(Auth::id())->get();
        return json_success([
            'items' => $items,
            'total' => $items->count()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats()
    {
        $stats = $this->shop()->stats()->firstOrCreate();
        return json_success([
            'stat' => $stats,
            'stats' => $stats
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchShop(Request $request)
    {
        $session = EcomShopSession::firstOrCreate(['uid' => Auth::id()]);
        $session->shop()->associate($request->input('shop_id'))->save();
        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if ($shop = $this->shop()) {
            $shop->fill($request->input('data', []))->save();
            $shop->refresh();
        }

        return json_success(['shop' => $shop]);
    }
}

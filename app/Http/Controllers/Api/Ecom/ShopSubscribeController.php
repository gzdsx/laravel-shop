<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopSubscribeController extends BaseController
{
    /**
     * @return \App\Models\EcomShop|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function repository()
    {
        return Auth::user()->subscribedShops();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $result = $this->repository()->syncWithoutDetaching([$shop_id]);
        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $result = $this->repository()->detach([$shop_id]);
        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $result = $this->repository()->toggle([$shop_id]);

        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $subscribe = $this->repository()->whereKey($shop_id)->exists();

        return jsonSuccess(compact('subscribe'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('ecom_shop_subscribe.id')->get()
        ]);
    }
}

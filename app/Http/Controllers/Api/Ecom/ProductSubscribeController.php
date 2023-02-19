<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSubscribeController extends BaseController
{
    /**
     * @return \App\Models\EcomProductItem|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function repository()
    {
        return Auth::user()->subscribedProducts();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid');
        $result = $this->repository()->syncWithoutDetaching([$itemid]);
        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $itemid = $request->input('itemid');
        $result = $this->repository()->detach([$itemid]);
        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $itemid = $request->input('itemid');
        $result = $this->repository()->toggle([$itemid]);

        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request)
    {
        $itemid = $request->input('itemid');
        $subscribe = $this->repository()->whereKey($itemid)->exists();

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
                ->orderByDesc('ecom_product_subscribe.id')->get()
        ]);
    }
}

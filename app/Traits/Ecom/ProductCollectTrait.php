<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 10:04
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ProductCollectTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function repository()
    {
        return Auth::user()->productCollects();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid');
        if (!$collect = $this->repository()->where('itemid', $itemid)->first()) {
            $product = EcomProductItem::find($itemid);
            $collect = $this->repository()->create([
                'itemid' => $itemid,
                'image' => $product->image,
                'price' => $product->price,
                'title' => $product->title
            ]);
            $product->collections++;
            $product->save();
        }
        return $this->sendSaveResponse($request, $collect);
    }

    /**
     * @param Request $request
     * @param $collect
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSaveResponse(Request $request, $collect)
    {
        return jsonSuccess(['collect' => $collect]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereIn('itemid', $request->input('items', []))->delete();
        return $this->sendDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedResponse(Request $request)
    {
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function batchget(Request $request)
    {
        $query = $this->repository();
        $total = $query->count();
        $items = $query->with('product')
            ->offset($request->input('offset', 0))
            ->take($request->input('count', 10))
            ->orderByDesc('id')->get();
        return $this->showCollectedItemsView($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param $items
     * @return mixed
     */
    protected function showCollectedItemsView(Request $request, $items, $total)
    {
        return jsonSuccess([
            'total' => $total,
            'items' => $items
        ]);
    }
}

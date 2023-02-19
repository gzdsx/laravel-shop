<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/5/10
 * Time: 1:15 上午
 */

namespace App\Traits\Trade;


use App\Jobs\RefundMoneyJob;
use App\Models\OrderItem;
use App\Models\Refund;
use App\Support\TradeUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RefundTrait
{
    /**
     * @return Refund|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Refund::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->load(['images', 'shipping', 'user']);
        $trade = $refund->trade;
        $order = $trade->order;
        return jsonSuccess([
            'refund' => $refund,
            'trade' => $trade,
            'order' => $order
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->filter($request->all());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('refund_id')->get()
        ]);
    }

    /**
     * 申请退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $trade = OrderItem::findOrFail($request->input('trade_id'));

        $refund = new Refund();
        $refund->refund_amount = $request->input('refund_amount');
        $refund->refund_desc = $request->input('refund_desc');
        $refund->refund_type = $request->input('refund_type');
        $refund->refund_reason = $request->input('refund_reason');
        $refund->goods_state = $request->input('goods_state');
        $refund->refund_no = TradeUtil::createReundNo();
        $refund->refund_state = 0;
        $refund->user()->associate(Auth::user());
        $refund->trade()->associate($trade->trade_id);
        $refund->order()->associate($trade->order_id);
        $refund->save();

        foreach ($request->input('images', []) as $image) {
            $refund->images()->create($image);
        }

        $refund->refresh();

        $trade->refund_state = 1;
        $trade->save();

        return jsonSuccess($refund);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_amount = $request->input('refund_amount');
        $refund->refund_desc = $request->input('refund_desc');
        $refund->refund_reason = $request->input('refund_reason');
        $refund->goods_state = $request->input('goods_state');
        $refund->refund_state = 0;
        $refund->save();

        $refund->images()->delete();
        foreach ($request->input('images', []) as $image) {
            $refund->images()->create($image);
        }

        return jsonSuccess($refund);
    }

    /**
     * 取消退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function revoke(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_state = 20;
        $refund->save();

        if ($trade = $refund->trade) {
            $trade->refund_state = 0;
            $trade->save();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        if ($refund = $this->repository()->find($request->input('refund_id'))) {
            $refund->delete();
        }
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_state = 3;
        $refund->shipping_state = 1;
        $refund->shipping_at = now();
        $refund->save();

        $shipping = $refund->shipping()->firstOrNew([]);
        $shipping->express_name = $request->input('express_name');
        $shipping->express_code = $request->input('express_code');
        $shipping->express_no = $request->input('express_no');

        $address = $request->input('address', []);
        $shipping->fill($address);
        $shipping->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resolve(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        //仅退款
        if ($refund->refund_type == 1) {
            $refund->refund_state = 4;
            $refund->save();

            dispatch(new RefundMoneyJob($refund));
        }

        //退款退货
        if ($refund->refund_type == 2) {
            if ($refund->refund_state == 0) {
                $refund->refund_state = 2;
                $refund->save();
            }

            if ($refund->refund_state == 3) {
                $refund->refund_state = 4;
                $refund->save();

                dispatch(new RefundMoneyJob($refund));
            }
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_state = 1;
        $refund->save();

        return jsonSuccess($refund);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateShipping(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $shipping = $refund->shipping()->firstOrNew([]);
        $shipping->fill($request->input('shipping', []))->save();

        return jsonSuccess();
    }
}

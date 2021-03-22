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

namespace App\Traits\Order;


use App\Jobs\RefundMoneyJob;
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
    public function get(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->load(['items', 'images', 'shipping', 'order', 'user']);
        return jsonSuccess(['refund' => $refund]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository();
        if (is_numeric($state = $request->input('refund_state'))) {
            $query->where('refund_state', $state);
        }
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->orderByDesc('refund_id')->get()
        ]);
    }

    /**
     * 申请退货
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request)
    {
        if ($refund_id = $request->input('refund_id')) {
            $refund = Refund::find($refund_id);
            $refund->load(['items', 'images', 'order']);
        } else {
            $refund = new Refund();
            $order = Auth::user()->boughts()->find($request->input('order_id'));
            $items = $order->items()->where('refund_state', 0)->whereKey($request->input('suborders', []))->get();
            $refund_amount = 0;
            $shipping_fee = 0;
            foreach ($items as $item) {
                $refund_amount = bcadd($refund_amount, $item->total_fee, 2);
                $shipping_fee = bcadd($shipping_fee, $item->shipping_fee, 2);
                $refund->items->push($item);
            }

            $refund->refund_id = 0;
            $refund->refund_amount = $refund_amount;
            $refund->shipping_fee = $shipping_fee;
            $refund->refund_state = 1;
            $refund->refund_type = $request->input('refund_type', 1);
            $refund->receive_state = 1;
            $refund->order()->associate($order);
            $refund->load(['images']);
        }

        return jsonSuccess(['refund' => $refund]);
    }

    /**
     * 申请退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = Auth::user()->boughts()->find($order_id);
        $refund = $this->repository()->make($request->input('refund', []));
        $refund->refund_no = TradeUtil::createReundNo();
        $refund->refund_state = 1;
        $refund->order()->associate($order);
        $refund->user()->associate(Auth::user());
        $refund->save();

        foreach ($request->input('images', []) as $image) {
            $refund->images()->create($image);
        }

        $items = $order->items()->whereKey($request->input('suborders', []))->where('refund_state', 0)->get();
        foreach ($items as $item) {
            $item->refund_id = $refund->refund_id;
            $item->refund_state = $refund->refund_state;
            $item->save();
        }

        return jsonSuccess(['refund' => $refund]);
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
        $refund->refund_state = 6;
        $refund->save();

        return jsonSuccess(['refund' => $refund]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $refunds = $this->repository()->whereKey($request->input('items', []))->get();
        foreach ($refunds as $refund) {
            $refund->delete();
        }
        return jsonSuccess();
    }

    /**
     * 更新退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->fill($request->input('refund', []));
        $refund->refund_state = 1;
        $refund->save();

        $refund->images()->delete();
        foreach ($request->input('images', []) as $image) {
            $refund->images()->create($image);
        }

        return jsonSuccess(['refund' => $refund]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_state = 4;
        $refund->save();

        $shipping = $refund->shipping()->firstOrNew([]);
        $shipping->fill($request->input('shipping', []))->save();

        return jsonSuccess(['refund' => $refund]);
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
            $refund->refund_state = 5;
            $refund->save();

            $refund->items()->update(['refund_state' => 2]);

            dispatch_now(new RefundMoneyJob($refund));
        }

        //退款退货
        if ($refund->refund_type == 2) {
            if ($refund->refund_state == 1) {
                $refund->refund_state = 3;
                $refund->save();
            }

            if ($refund->refund_state == 4) {
                $refund->refund_state = 5;
                $refund->save();

                $refund->items()->update(['refund_state' => 2]);

                dispatch_now(new RefundMoneyJob($refund));
            }
        }

        return jsonSuccess(['refund' => $refund]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(Request $request)
    {
        $refund = $this->repository()->findOrFail($request->input('refund_id'));
        $refund->refund_state = 2;
        $refund->save();

        return jsonSuccess(['refund' => $refund]);
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

        return jsonSuccess(['shipping' => $shipping]);
    }
}

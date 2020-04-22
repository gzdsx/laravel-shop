<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/21
 * Time: 9:11 下午
 */

namespace App\Traits\Order;


use App\Events\OrderEvent;
use App\Models\Express;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

trait SoldTrait
{
    /**
     * @return Order|\Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return Order::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request){
        $order = $this->query()->findOrFail($request->input('order_id'));
        $order->load(['buyer','shipping','items','transaction']);

        return ajaxReturn(['order'=>$order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request){
        $query = $this->query()->filter($request->all())->with(['items']);
        return ajaxReturn([
            'total'=>$query->count(),
            'items'=>$query->offset($request->input('offset',0))
                ->limit($request->input('count',10))->orderByDesc('order_id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPrice(Request $request){
        $item = OrderItem::find($request->input('id'));
        if ($item){
            $price = $request->input('price');
            $quantity = $request->input('quantity');
            $total_fee = $price*$quantity+$item->shipping_fee;
            $item->fill(compact('price','quantity','total_fee'))->save();

            $order = $this->query()->find($item->order_id);
            $order->total_fee = $order->items()->sum('total_fee');
            $order->total_count = $order->items()->sum('quantity');
            $order->order_fee = $order->total_fee - $order->shipping_fee;
            $order->save();
        }
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request){
        $order = $this->query()->findOrFail($request->input('order_id'));
        $order->order_state = 3;
        $order->shipping_state = 1;
        $order->shipping_at = now();
        $order->save();

        if ($order->shipping) {
            $order->shipping->express_code = $request->input('express_code');
            $order->shipping->express_name = $request->input('express_name');
            $order->shipping->express_no = $request->input('express_no');
            $order->shipping->save();
        }

        event(new OrderEvent($order, 'send'));
        return ajaxReturn();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiRequestException;
use App\Library\Mall\Seller\SoldManagers;
use Illuminate\Http\Request;

class SoldController extends BaseController
{
    use SoldManagers;

    /**
     * 获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiRequestException
     */
    public function get(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = $this->user()->solds()->with(['shop', 'items', 'shipping', 'transaction'])->find($order_id);

        if ($order) {
            return ajaxReturn(['order' => $order]);
        } else {
            throw new ApiRequestException(trans('order.order does not exist'), 404);
        }
    }

    /**
     * 批量获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $query = $this->user()->solds()->with('items')->where('seller_deleted', 0);

        $tradeState = $request->input('tradeState', 0);
        if ($tradeState) {
            $query = $query->where('order_state', $tradeState);
        }

        $tradeCode = $request->input('tradeCode', '');
        if ($tradeCode == 'waitPay') {
            $query = $query->where('order_state', 1);
        }
        if ($tradeCode == 'waitSend') {
            $query = $query->where('order_state', 2);
        }
        if ($tradeCode == 'waitConfirm') {
            $query = $query->where('order_state', 3);
        }
        if ($tradeCode == 'waitRate') {
            $query = $query->where('order_state', 4)->where('buyer_rate', 0);
        }
        if ($tradeCode == 'refunding') {
            $query = $query->where('order_state', 5);
        }

        $items = $query->offset($offset)->limit($count)->orderByDesc('order_id')->get();
        $items->each(function ($order) {
            $order->quantity = 0;
            $order->buyer_avatar = avatar($order->buyer_uid);
            $order->items->each(function ($item) use (&$order) {
                $order->quantity += $item->quantity;
            });
        });

        return ajaxReturn(['items' => $items]);
    }
}

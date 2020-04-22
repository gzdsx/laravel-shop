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


use App\Models\Order;
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
}

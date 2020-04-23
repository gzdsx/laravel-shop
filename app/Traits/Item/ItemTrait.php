<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/23
 * Time: 11:47 下午
 */

namespace App\Traits\Item;


use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ItemTrait
{

    /**
     * @return Item|Builder
     */
    protected function query()
    {
        return Item::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $item = $this->getItemById($request->input('itemid'));
        return $this->sendGetItemResponse($request, $item);
    }

    /**
     * @param $itemid
     * @return Item|Item[]|Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    protected function getItemById($itemid){
        $item = $this->query()->findOrFail($itemid);
        $item->load(['images', 'props', 'skus', 'content', 'catlogs']);
        return $item;
    }

    /**
     * @param Request $request
     * @param Item|\Illuminate\Database\Eloquent\Builder $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetItemResponse(Request $request, $item)
    {
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 10);
        $query = $this->query()->orderByDesc('itemid')->filter($request->all());
        $total = $query->count();
        $items = $this->query()->offset($offset)->limit($count)->get();
        return $this->sendBatchGetItemResponse($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param Item[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection $items
     * @param int $total
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchGetItemResponse(Request $request, $items, $total)
    {
        return ajaxReturn(compact('total', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Request $request)
    {
        $paginator = $this->query()->orderByDesc('itemid')->filter($request->all())->paginate($request->input('pagesize', 15));
        return $this->sendPaginateItemResponse($request, $paginator);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaginateItemResponse(Request $request, $paginator)
    {
        return ajaxReturn([
            'total' => $paginator->total(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'pageSize' => $paginator->perPage(),
            'items' => $paginator->items()
        ]);
    }
}

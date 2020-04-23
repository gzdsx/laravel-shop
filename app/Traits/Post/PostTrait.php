<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/24
 * Time: 2:13 上午
 */

namespace App\Traits\Post;


use App\Models\PostItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait PostTrait
{
    /**
     * @return PostItem|Builder
     */
    protected function query()
    {
        return PostItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $post = $this->query()->findOrFail($request->input('aid'));
        $post->load(['user', 'content', 'images', 'media', 'catlog']);

        return $this->sendGetPostResponse($request, $post);
    }

    /**
     * @param Request $request
     * @param PostItem|\Illuminate\Database\Eloquent\Builder $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetPostResponse(Request $request, $post)
    {
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->query()->filter($request->all());
        $total = $query->count();
        $items = $query->offset($request->input('offset', 0))
            ->limit($request->input('count', 15))->get();
        return $this->sendBatchGetPostResponse($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param PostItem[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[] $items
     * @param int $total
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchGetPostResponse(Request $request, $items, $total)
    {
        return ajaxReturn(compact('total', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Request $request)
    {
        $paginator = $this->query()->filter($request->all())->paginate($request->input('pagesize', 15));
        return $this->sendPaginatePostResponse($request, $paginator);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaginatePostResponse(Request $request, $paginator)
    {
        return ajaxReturn([
            'total' => $paginator->total(),
            'pageSize' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'items' => $paginator->items(),
        ]);
    }
}

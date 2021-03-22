<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/12/20
 * Time: 10:08
 */

namespace App\Traits\Common;


use App\Models\Page;
use Illuminate\Http\Request;

trait PageTrait
{
    /**
     * @return Page|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Page::query();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        return ['page' => $this->repository()->findOrNew($request->input('pageid'))];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->whereType($request->input('type','page'));
        if ($catid = $request->input('catid')) {
            $items = $query->where('catid', $catid)->get();
        } else {
            $items = $query->get();
        }

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $page = $this->repository()->findOrNew($request->input('pageid'));
        $page->fill($request->input('page',[]))->save();
        return jsonSuccess(['page' => $page]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}

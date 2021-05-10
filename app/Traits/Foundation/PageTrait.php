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

namespace App\Traits\Foundation;


use App\Models\Page;
use App\Models\PageCategory;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['page' => $this->repository()->findOrNew($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $columns = ['id', 'catid', 'title', 'alias', 'image', 'template', 'displayorder'];
        if ($catid = $request->input('catid')) {
            $items = $this->repository()->where('catid', $catid)->get($columns);
        } else {
            $items = $this->repository()->get();
        }

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request)
    {
        return jsonSuccess(['items' => PageCategory::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $page = $this->repository()->findOrNew($request->input('id'));
        $page->fill($request->input('page', []))->save();
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

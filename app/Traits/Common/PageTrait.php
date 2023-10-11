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
use Overtrue\LaravelPinyin\Facades\Pinyin;

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
    public function page(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pages(Request $request)
    {
        $query = $this->repository();
        $total = $query->count();
        $items = $query->get();

        return json_success(['items' => $items, 'total' => $total]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $page = $request->input('page');
        $model = $this->repository()->findOrNew($page['id'] ?? 0);
        $model->fill($page);
        if (!$model->name) {
            $model->name = Pinyin::permalink($model->title);
        }
        $model->save();
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        return json_success();
    }
}

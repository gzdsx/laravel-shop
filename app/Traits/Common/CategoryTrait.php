<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/20
 * Time: 5:25 下午
 */

namespace App\Traits\Common;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait CategoryTrait
{
    /**
     * @return Category|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Category::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $model = $this->repository()->with('children')->findOrFail($request->input('cate_id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request)
    {
        $query = $this->repository()
            ->where('taxonomy', $request->input('taxonomy', 'category'))
            ->where('parent_id', $request->input('parent_id', 0));
        return json_success([
            'total' => $query->count(),
            'items' => $query->with('children')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $parent_id = $request->input('parent_id', 0);
        return json_success(['items' => $this->repository()->where('parent_id', $parent_id)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $category = $request->input('category', []);
        $model = $this->repository()->findOrNew($category['cate_id'] ?? 0);
        $model->fill($category);
        $model->slug = \Overtrue\LaravelPinyin\Facades\Pinyin::permalink($model->name);
        $model->save();

        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(Request $request)
    {
        $model = $this->repository()->find($request->input('cate_id'));
        $prev = $model->siblings()->where('sort_num', '<', $model->sort_num)->max('sort_num');
        $model->sort_num = $prev > 0 ? $prev - 1 : 0;
        $model->save();

        return json_success();
    }

    public function decrease(Request $request)
    {
        $model = $this->repository()->find($request->input('cate_id'));
        $next = $model->siblings()->where('sort_num', '>', $model->sort_num)->min('sort_num');
        $model->sort_num = $next + 1;
        $model->save();

        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        foreach ($request->input('ids', []) as $cate_id) {
            $this->deleteAll($cate_id);
        }
        return json_success();
    }

    /**
     * @param $catid
     * @throws \Exception
     */
    private function deleteAll($cate_id)
    {
        $category = $this->repository()->find($cate_id);
        if ($category) {
            if ($category->children) {
                foreach ($category->children as $child) {
                    $this->deleteAll($child->cate_id);
                }
            }
            $category->delete();
        }
    }
}

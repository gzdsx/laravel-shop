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


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Overtrue\Pinyin\Pinyin;

trait CategoryTrait
{
    /**
     * @return Model
     */
    abstract protected function repository();

    protected function updateCache()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $category = $this->repository()->with('children')->findOrFail($request->input('cate_id'));
        return jsonSuccess($category);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->with('children')->where('parent_id', 0)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $parent_id = $request->input('parent_id', 0);
        return jsonSuccess(['items' => $this->repository()->where('parent_id', $parent_id)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('cate_id'));
        $model->fill($request->input('category', []));

        if ($model->parent) {
            $model->level = $model->parent->level + 1;
        } else {
            $model->level = 1;
        }

        $pinyin = new Pinyin();
        $model->identifier = $pinyin->permalink($model->cate_name, '');

        $model->save();
        $this->updateCache();
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(Request $request)
    {
        $model = $this->repository()->find($request->input('cate_id'));
        $min = $this->repository()->where('sort_num', '>', $model->sort_num)->min('sort_num');
        $model->sort_num = $min + 1;
        $model->save();
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decrease(Request $request)
    {
        $model = $this->repository()->find($request->input('cate_id'));
        $max = $this->repository()->where('sort_num', '<', $model->sort_num)->max('sort_num');
        $model->sort_num = $max > 0 ? $max - 1 : 0;
        $model->save();
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upgrade(Request $request)
    {
        $model = $this->repository()->find($request->input('cate_id'));
        if ($model->parent) {
            $model->parent_id = $model->parent->parent_id;
            $model->save();
            $this->updateCache();
        }
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->deleteAll($request->input('cate_id'));
        $this->updateCache();
        return jsonSuccess();
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

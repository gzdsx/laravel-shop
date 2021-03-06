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

namespace App\Traits\Foundation;


use App\Support\PinyinUtil;
use Illuminate\Http\Request;

trait CategoryTrait
{
    abstract protected function repository();

    protected function updateCache()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['category' => $this->repository()->findOrFail($request->input('catid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->with('children')->where('fid', 0)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $fid = $request->input('fid', 0);
        return jsonSuccess(['items' => $this->repository()->where('fid', $fid)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $catid = $request->input('catid', 0);
        $category = $this->repository()->findOrNew($catid);
        $category->fill($request->input('category', []));

        if ($category->parent) {
            $category->level = $category->parent->level + 1;
        } else {
            $category->level = 1;
        }

        if (!$category->identifier) {
            $category->identifier = PinyinUtil::pinyin($category->name);
        }

        $category->save();

        if (!$category->displayorder) {
            $category->displayorder = $category->catid ?? 0;
            $category->save();
        }

        $this->updateCache();
        return jsonSuccess(['category' => $category]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(Request $request)
    {
        $category = $this->repository()->find($request->input('catid'));
        $category->displayorder--;
        $category->save();
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decrease(Request $request)
    {
        $category = $this->repository()->find($request->input('catid'));
        $category->displayorder++;
        $category->save();
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upgrade(Request $request)
    {
        $category = $this->repository()->find($request->input('catid'));
        if ($category->parent) {
            $category->fid = $category->parent->fid;
            $category->save();
            $this->updateCache();
        }
        return jsonSuccess(['category' => $category]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->deleteAll($request->input('catid'));
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param $catid
     * @throws \Exception
     */
    private function deleteAll($catid)
    {
        $category = $this->repository()->find($catid);
        if ($category) {
            $category->delete();
            if ($category->children) {
                foreach ($category->children as $child) {
                    $this->deleteAll($child->catid);
                }
            }
        }
    }
}

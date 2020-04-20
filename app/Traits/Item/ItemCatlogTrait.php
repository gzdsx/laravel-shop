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

namespace App\Traits\Item;


use App\Models\ItemCatlog;
use Illuminate\Http\Request;

trait ItemCatlogTrait
{
    /**
     * @return ItemCatlog|\Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return ItemCatlog::query();
    }

    protected function updateCache()
    {
        ItemCatlog::updateCache();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['catlog' => $this->query()->findOrFail($request->input('catid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return ajaxReturn(['items' => ItemCatlog::fetchWithCache()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $catid = $request->input('catid', 0);
        $attributes = collect($request->input('catlog', []));
        if ($attributes->count()) {
            if ($attributes->has('fid')) {
                if ($parent = $this->query()->find($attributes->get('fid'))) {
                    $attributes->put('level', $parent->level + 1);
                }
            }
            $catlog = $this->query()->findOrNew($catid);
            $catlog->fill($attributes->except('catid')->all())->save();

            $this->updateCache();
            return ajaxReturn(['catlog' => $catlog]);
        }
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upgrade(Request $request)
    {
        $catlog = $this->query()->find($request->input('catid'));
        $max = $catlog->siblings()->where('displayorder', '<', $catlog->displayorder)->max('displayorder');
        $catlog->displayorder = $max - 1;
        $catlog->save();
        $this->updateCache();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downgrade(Request $request)
    {
        $catlog = $this->query()->find($request->input('catid'));
        $min = $catlog->siblings()->where('displayorder', '>', $catlog->displayorder)->min('displayorder');
        $catlog->displayorder = $min + 1;
        $catlog->save();
        $this->updateCache();
        return ajaxReturn();
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
        return ajaxReturn();
    }

    /**
     * @param $catid
     * @throws \Exception
     */
    private function deleteAll($catid)
    {
        $catlog = ItemCatlog::find($catid);
        if ($catlog) {
            $catlog->delete();
            if ($catlog->children) {
                foreach ($catlog->children as $child) {
                    $this->deleteAll($catid->catid);
                }
            }
        }
    }
}

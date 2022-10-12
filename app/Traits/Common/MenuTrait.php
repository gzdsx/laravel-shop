<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/5/11
 * Time: 00:43
 */

namespace App\Traits\Common;


use App\Models\CommonMenu;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

trait MenuTrait
{
    /**
     * @return CommonMenu|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonMenu::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $menu = $this->repository()->findOrFail($request->input('id'));
        $items = $menu->visibleItems()->with(['children' => function (HasMany $hasMany) {
            return $hasMany->where('hide', 0);
        }])->where('parent_id', 0)->get();

        return jsonSuccess(['menu' => $menu, 'items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('menu', []))->save();
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($model = $this->repository()->find($request->input('id'))) {
            $model->delete();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }
}

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
 * Time: 00:48
 */

namespace App\Traits\Common;


use App\Models\CommonMenu;
use App\Models\CommonMenuItem;
use Illuminate\Http\Request;

trait MenuItemTrait
{
    protected function repository()
    {
        return CommonMenuItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $menu = CommonMenu::findOrFail($request->input('menu_id'));
        $items = $menu->items()->with(['children'])->where('parent_id', 0)->get();

        return jsonSuccess(['items' => $items, 'menu' => $menu]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('item', []))->save();
        if (!$model->sort_num) {
            $model->sort_num = $model->id;
            $model->save();
        }
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        $model->hide = $model->hide === 0 ? 1 : 0;
        $model->save();

        return jsonSuccess();
    }
}

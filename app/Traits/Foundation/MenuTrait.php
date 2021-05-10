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

namespace App\Traits\Foundation;


use App\Models\Menu;
use Illuminate\Http\Request;

trait MenuTrait
{
    /**
     * @return Menu|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Menu::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $menu = $this->repository()->findOrFail($request->input('menu_id'));
        return jsonSuccess([
            'menu' => $menu,
            'items' => $menu->items()->with('children')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $menu = $this->repository()->findOrNew($request->input('menu_id'));
        $menu->fill($request->input('menu', []))->save();
        $this->updateCache();
        return jsonSuccess(['menu' => $menu]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function ($menu) {
            $menu->delete();
        });

        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @throws \Exception
     */
    protected function updateCache()
    {
        foreach ($this->repository()->get() as $menu) {
            $items = $menu->items()->with(['children'])->where('fid', 0)->get();
            cache(['menu_' . $menu->menu_id => $items]);
        }
    }
}

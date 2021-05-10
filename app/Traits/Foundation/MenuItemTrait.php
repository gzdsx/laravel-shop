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

namespace App\Traits\Foundation;


use App\Models\MenuItem;
use Illuminate\Http\Request;

trait MenuItemTrait
{
    protected function repository()
    {
        return MenuItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['item' => $this->repository()->find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = $this->repository()->with(['children'])->where([
            'fid' => 0,
            'menu_id' => $request->input('menu_id')
        ])->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $item = $this->repository()->findOrNew($request->input('id'));
        $item->fill($request->input('item', []))->save();
        if (!$item->displayorder) {
            $item->displayorder = $item->id;
            $item->save();
        }
        return jsonSuccess(['item' => $item]);
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

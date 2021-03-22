<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends BaseController
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
        return jsonSuccess(['menu' => $this->repository()->find($request->input('menu_id'))]);
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
        $this->repository()->whereKey($request->input('items', []))->get()->map(function (Menu $menu) {
            $menu->delete();
        });

        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request)
    {
        return jsonSuccess(['item' => MenuItem::find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetItem(Request $request)
    {
        $items = MenuItem::with(['children'])->where([
            'fid' => 0,
            'menu_id' => $request->input('menu_id')
        ])->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveItem(Request $request)
    {
        $item = MenuItem::findOrNew($request->input('id'));
        $item->fill($request->input('item', []))->save();
        if (!$item->displayorder) {
            $item->displayorder = $item->id;
            $item->save();
        }
        $this->updateCache();
        return jsonSuccess(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request)
    {
        MenuItem::whereKey($request->input('items', []))->get()->map(function (MenuItem $menuItem) {
            $menuItem->delete();
        });
        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @throws \Exception
     */
    private function updateCache()
    {
        foreach ($this->repository()->get() as $menu) {
            $items = $menu->items()->with(['children'])->where('fid', 0)->get();
            cache(['menu_' . $menu->menu_id => $items]);
        }
    }
}

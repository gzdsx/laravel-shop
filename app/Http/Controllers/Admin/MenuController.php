<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $items = Menu::with('items')->onlyMenu()->get();

        return $this->view('admin.menu.menus', ['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveMenu(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) {
            Menu::whereIn('id', $delete)->delete();
            Menu::whereIn('menuid', $delete)->delete();
        }

        $items = $request->post('items', []);
        if ($items) {
            foreach ($items as $id => $menu) {
                if ($menu['name']) {
                    if ($id > 0) {
                        Menu::where('id', $id)->update($menu);
                    } else {
                        Menu::create($menu);
                    }
                }
            }
        }
        return $this->messager()->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function items(Request $request)
    {
        $menuid = $request->get('menuid');
        $menu = Menu::with('items')->find($menuid);
        return $this->view('admin.menu.items', compact('menuid', 'menu'));
    }

    public function saveItems(Request $request)
    {
        return $this->messager()->render();
    }
}

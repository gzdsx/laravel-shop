<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\WechatMenuRepositoryInterface;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class WechatMenuController extends BaseController
{
    use WechatDefaultConfig;

    protected $menuRepository;

    public function __construct(Request $request, WechatMenuRepositoryInterface $menuRepository)
    {
        parent::__construct($request);
        $this->menuRepository = $menuRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menus = $this->menuRepository->with('childs')->where('fid', 0)->orderBy('id')->get();
        return $this->view('admin.wechat.menus', compact('menus'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function batchUpdate(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) $this->menuRepository->whereKey($delete)->delete();

        $menus = $request->post('menus', []);
        if ($menus) {
            foreach ($menus as $id => $menu) {
                if ($menu['name']) {
                    if ($id > 0) {
                        $this->menuRepository->whereKey($id)->update($menu);
                    } else {
                        $this->menuRepository->create($menu);
                    }
                }
            }
        }
        return $this->messager()->setMessage(trans('sysmessage.info update success'))->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newMenu(Request $request)
    {
        $id = $request->input('id', 0);
        $fid = $request->input('fid', 0);
        $menu = $this->menuRepository->findOrNew($id);
        $menu_types = trans('wechat.menu_types');

        return $this->view('admin.wechat.newmenu', compact('id', 'fid', 'menu', 'menu_types'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMenu(Request $request)
    {
        $id = $request->input('id', 0);
        $menu = $request->input('menu', []);
        if ($id) {
            $this->menuRepository->whereKey($id)->update($menu);
        } else {
            $this->menuRepository->create($menu);
        }
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyMenu()
    {

        $menus = $this->menuRepository->with('childs')->where('fid', 0)->orderBy('id')->all();
        if ($menus) {
            $buttons = [];
            foreach ($menus as $menu) {
                if ($menu->childs->count() > 0) {
                    $sub_button = [];
                    foreach ($menu->childs as $child) {
                        //网页
                        if ($child->type == 'view') {
                            if ($child->name && $child->url) {
                                $sub_button[] = [
                                    'type' => $child->type,
                                    'name' => $child->name,
                                    'url' => $child->url
                                ];
                            }
                        } elseif ($child->type == 'view_limited') {
                            if ($child->media_id) {
                                $sub_button[] = [
                                    'type' => $child->type,
                                    'name' => $child->name,
                                    'media_id' => $child->media_id
                                ];
                            }
                        } elseif ($child->type == 'miniprogram') {
                            $sub_button[] = [
                                'type' => $child->type,
                                'name' => $child->name,
                                'url' => $child->url,
                                'appid' => $child->appid,
                                'pagepath' => $child->pagepath
                            ];
                        } else {
                            if ($child->key) {
                                $sub_button[] = [
                                    'type' => $child->type,
                                    'name' => $child->name,
                                    'key' => $child->key
                                ];
                            }
                        }
                    }
                    $buttons[] = [
                        'name' => $menu->name,
                        'sub_button' => $sub_button
                    ];
                } else {
                    if ($menu->type == 'view') {
                        if ($menu->url) {
                            $buttons[] = [
                                'type' => $menu->type,
                                'name' => $menu->name,
                                'url' => $menu->url
                            ];
                        }
                    } elseif ($menu->type == 'view_limited') {
                        if ($menu->media_id) {
                            $buttons[] = [
                                'type' => $menu->type,
                                'name' => $menu->name,
                                'media_id' => $menu->media_id
                            ];
                        }
                    } elseif ($menu->type == 'miniprogram') {
                        if ($menu->appid && $menu->pagepath) {
                            $buttons[] = [
                                'type' => $menu->type,
                                'name' => $menu->name,
                                'url' => $menu->url,
                                'appid' => $menu->appid,
                                'pagepath' => $menu->pagepath
                            ];
                        }
                    } else {
                        if ($menu->key) {
                            $buttons[] = [
                                'type' => $menu->type,
                                'name' => $menu->name,
                                'key' => $menu->key
                            ];
                        }
                    }
                }
            }

            $res = $this->officialAccount()->menu->create($buttons);
            if ($res['errcode']) {
                return ajaxError($res['errcode'], $res['errmsg']);
            } else {
                return ajaxReturn($res);
            }
        } else {
            return ajaxError(404, 'not found');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMenu()
    {
        $res = $this->officialAccount()->menu->delete();
        if ($res['errcode']) {
            return ajaxError($res['errcode'], $res['errmsg']);
        } else {
            return ajaxReturn($res);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WechatMenu;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class WechatMenuController extends BaseController
{
    use WechatDefaultConfig;
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return ajaxReturn(['items' => WechatMenu::with('children')->where('fid', 0)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTypes(Request $request)
    {
        return ajaxReturn(['items' => __('wechat.menu_types')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $menu = WechatMenu::findOrNew($request->input('id', 0));
        $menu->fill($request->input('menu', []))->save();
        return ajaxReturn(['menu' => $menu]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        WechatMenu::whereKey($request->input('id', 0))->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apply(Request $request)
    {
        $menus = WechatMenu::with('children')->where('fid', 0)->orderBy('id')->get();
        if ($menus) {
            $buttons = [];
            foreach ($menus as $menu) {
                if ($menu->children->count() > 0) {
                    $sub_button = [];
                    foreach ($menu->children as $child) {
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

            try {
                $res = $this->officialAccount()->menu->create($buttons);
                return ajaxReturn($res);
            }catch (\GuzzleHttp\Exception\GuzzleException $exception){
                return ajaxError($exception->getCode(), $exception->getMessage());
            }
        } else {
            return ajaxError(404, 'not found');
        }
    }
}

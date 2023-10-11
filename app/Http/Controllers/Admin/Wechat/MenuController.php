<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Admin\BaseController;
use App\Models\WechatMenu;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @return WechatMenu|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return WechatMenu::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function menus(Request $request)
    {
        $items = $this->repository()->with('children')->where('parent_id', 0)->get();
        return json_success(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function types(Request $request)
    {
        return json_success(['items' => trans('wechat.menu.types')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newMenu = $request->input('menu', []);
        $menu = $this->repository()->findOrNew($newMenu['id'] ?? 0);
        $menu->fill($newMenu)->save();
        return json_success($menu);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('id', 0))->delete();
        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apply(Request $request)
    {
        $menus = $this->repository()->with('children')->where('parent_id', 0)->get();
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
                return json_success($res);
            } catch (\GuzzleHttp\Exception\GuzzleException $exception) {
                return json_fail($exception->getMessage());
            }
        } else {
            return json_fail('not found', 404);
        }
    }
}

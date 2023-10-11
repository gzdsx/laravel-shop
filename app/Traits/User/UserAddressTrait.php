<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 17:43
 */

namespace App\Traits\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UserAddressTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function repository()
    {
        return Auth::user()->addresses();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('address', []));
        if ($model->isdefault == 1) {
            $this->repository()->update(['isdefault' => 0]);
        }
        $model->save();
        return json_success($model);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefault(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        if ($model) {
            $this->repository()->update(['isdefault' => 0]);
            $model->isdefault = 1;
            $model->save();
        }

        return json_success();
    }

    /**
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
     */
    public function getInfo(Request $request)
    {
        if ($id = $request->input('id')) {
            $model = $this->repository()->findOrFail($id);
        } else {
            $model = $this->repository()->orderByDesc('isdefault')->firstOrFail();
        }

        return json_success($model);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $items = $this->repository()->orderByDesc('isdefault')->get();
        return json_success(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $model = $this->repository()->make($request->input('address',[]));
        if ($model->isdefault) {
            $this->repository()->update(['isdefault' => 0]);
        }
        $model->save();

        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('address', []));
        if ($model->isdefault == 1) {
            $this->repository()->update(['isdefault' => 0]);
        }
        $model->save();
        return json_success($model);
    }
}

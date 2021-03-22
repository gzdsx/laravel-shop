<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/24
 * Time: 2:23 上午
 */

namespace App\Traits\User;


use App\Models\User;
use Illuminate\Http\Request;

trait UserTrait
{
    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return User::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['user' => $this->repository()->with('group')->find($request->input('uid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {

        $query = $this->repository()->filter($request->all())->with('group');
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))->limit(15)->get()
        ]);
    }
}

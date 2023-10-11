<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/12/20
 * Time: 07:50
 */

namespace App\Traits\Post;


use App\Models\PostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PostCollectTrait
{
    /**
     * @return PostItem|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function repository()
    {
        return Auth::user()->collectedPosts();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $aid = $request->input('aid');
        $result = $this->repository()->syncWithoutDetaching([$aid]);
        return json_success($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $aid = $request->input('aid');
        $result = $this->repository()->detach([$aid]);
        return json_success($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $aid = $request->input('aid');
        $result = $this->repository()->toggle([$aid]);

        return json_success($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request)
    {
        $aid = $request->input('aid');
        $collect = $this->repository()->find($aid);

        return json_success(compact('collect'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return json_success([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->get()
        ]);
    }
}

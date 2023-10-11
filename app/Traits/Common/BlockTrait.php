<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-26
 * Time: 09:00
 */

namespace App\Traits\Common;


use App\Models\CommonBlock;
use Illuminate\Http\Request;

trait BlockTrait
{
    /**
     * @return CommonBlock|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonBlock::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function block(Request $request)
    {
        $model = $this->repository()->with(['items'])->findOrFail($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function blocks(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository();

        return json_success([
            'total' => $query->count(),
            'items' => $query->offset($offset)->take($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newBlock = $request->input('block', []);
        $model = $this->repository()->findOrNew($newBlock['id'] ?? 0);
        $model->fill($newBlock)->save();
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return json_success();
    }
}

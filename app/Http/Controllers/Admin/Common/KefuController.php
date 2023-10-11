<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CommonKefu;
use Illuminate\Http\Request;

class KefuController extends BaseController
{
    protected function repository()
    {
        return CommonKefu::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function kefus(Request $request)
    {
        $query = $this->repository();
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        return json_success([
            'total' => $query->count(),
            'items' => $query->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newKefu = $request->input('kefu', []);
        $model = $this->repository()->findOrNew($newKefu['id'] ?? 0);
        $model->fill($newKefu)->save();

        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        return json_success();
    }
}

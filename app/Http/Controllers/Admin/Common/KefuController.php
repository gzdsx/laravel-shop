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
    public function getList(Request $request)
    {
        $query = $this->repository();
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        return jsonSuccess([
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
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('kefu', []))->save();

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        return jsonSuccess();
    }
}

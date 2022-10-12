<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CommonKefu;
use Illuminate\Http\Request;

class KefuController extends BaseController
{
    /**
     * @return CommonKefu|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonKefu::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $kefu = $this->repository()->find($request->input('id'));
        return jsonSuccess($kefu);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $kefu = $this->repository()->findOrNew($request->input('id'));
        $kefu->fill($request->input('kefu', []))->save();

        return jsonSuccess($kefu);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}

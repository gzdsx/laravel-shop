<?php

namespace App\Http\Controllers\Admin\Common;


use App\Http\Controllers\Admin\BaseController;
use App\Models\CommonLink;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @return CommonLink|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonLink::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->onlyLink();
        if ($cate_id = $request->input('cate_id')) {
            $query->where('cate_id', $cate_id);
        }
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryList(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->onlyCategory()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('link', []))->save();
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }
}

<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AdminGroup;
use Illuminate\Http\Request;

class AdminGroupController extends BaseController
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|AdminGroup
     */
    protected function repository()
    {
        return AdminGroup::query();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
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
        $model = $this->repository()->findOrNew($request->input('gid'));
        $model->fill($request->input('group', []));
        $model->save();

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

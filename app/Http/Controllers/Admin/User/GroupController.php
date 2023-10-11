<?php

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    /**
     * @return UserGroup|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return UserGroup::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function groups(Request $request)
    {
        return json_success(['items' => $this->repository()->orderBy('credits')->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newGroup = $request->input('group', []);
        $model = $this->repository()->findOrNew($newGroup['gid'] ?? 0);
        $model->fill($newGroup)->save();
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

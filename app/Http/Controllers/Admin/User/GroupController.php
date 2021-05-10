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
    public function get(Request $request)
    {
        $group = $this->repository()->find($request->input('gid'));
        return jsonSuccess(['group' => $group]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $group = $this->repository()->findOrNew($request->input('gid'));
        $group->fill($request->input('group', []))->save();
        return jsonSuccess(['group' => $group]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}

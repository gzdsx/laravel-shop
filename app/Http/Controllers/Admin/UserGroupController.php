<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $group = UserGroup::find($request->input('gid'));
        return ajaxReturn(['group' => $group]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return ajaxReturn(['items' => UserGroup::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $group = UserGroup::findOrNew($request->input('gid'));
        $group->fill($request->input('group', []))->save();
        return ajaxReturn(['group' => $group]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        UserGroup::whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }
}

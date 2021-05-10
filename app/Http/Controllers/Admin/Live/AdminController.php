<?php

namespace App\Http\Controllers\Admin\Live;

use App\Http\Controllers\Admin\BaseController;
use App\Models\LiveAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    /**
     * @return LiveAdmin|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return LiveAdmin::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['admin' => $this->repository()->find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->with('user')->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $uid = $request->input('uid');
        $remark = $request->input('remark');

        if (!User::whereKey($uid)->exists()) {
            abort(404, trans('user.account does not exist'));
        }

        $admin = $this->repository()->firstOrNew(['uid' => $uid]);
        $admin->fill(['remark' => $remark])->save();

        return jsonSuccess(['admin' => $admin]);
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

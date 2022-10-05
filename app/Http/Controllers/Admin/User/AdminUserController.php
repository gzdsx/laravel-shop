<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends BaseController
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|void
     */
    protected function repository()
    {
        return AdminUser::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->with(['user', 'group'])->whereHas('user')
                ->offset($offset)->limit($count)->orderBy('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $user = User::find($request->input('uid'));
        if (!$user) {
            return jsonError(500, trans('user.user does not exist'));
        }

        $model = $user->admin()->firstOrNew();
        $model->gid = $request->input('gid');
        $model->save();

        return jsonSuccess();
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

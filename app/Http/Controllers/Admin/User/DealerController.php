<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\UserDealer;
use Illuminate\Http\Request;

class DealerController extends BaseController
{
    /**
     * @return UserDealer|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return UserDealer::query();
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
            'items' => $query->with(['user'])->offset($offset)->limit($count)->get()
        ]);
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

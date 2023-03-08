<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomCoupon;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    /**
     * @return EcomCoupon|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomCoupon::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count('id'),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $coupon = $request->input('coupon', []);
        $model = $this->repository()->findOrNew($coupon['id'] ?? 0);
        $model->fill($coupon);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->update($request->input('data', []));
        return jsonSuccess();
    }
}

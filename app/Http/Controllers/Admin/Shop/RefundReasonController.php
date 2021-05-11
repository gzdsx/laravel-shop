<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Models\RefundReason;
use Illuminate\Http\Request;

class RefundReasonController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => RefundReason::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $reason = RefundReason::findOrNew($request->input('id'));
        $reason->fill($request->input('reason', []))->save();

        return jsonSuccess(compact('reason'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        RefundReason::whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}

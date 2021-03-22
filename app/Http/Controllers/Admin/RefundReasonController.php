<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundReason;
use Illuminate\Http\Request;

class RefundReasonController extends BaseController
{
    /**
     * @param Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
        return ['items' => RefundReason::all()];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
//        foreach ($request->input('items', []) as $k => $reason) {
//            $id = $reason['id'] ?? 0;
//            $reason['displayorder'] = $k;
//            RefundReason::findOrNew($id)->fill($reason)->save();
//        }

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

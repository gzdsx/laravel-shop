<?php

namespace App\Http\Controllers\Api\Trade;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Trade\RefundTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends BaseController
{
    use RefundTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->with(['items'])->where('uid', Auth::id());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->orderByDesc('refund_id')->get()
        ]);
    }
}

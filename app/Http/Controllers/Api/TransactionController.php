<?php

namespace App\Http\Controllers\Api;


use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $paginator = Transaction::filter($request->all())->with('payer')->paginate();
        return ajaxReturn([
            'total' => $paginator->total(),
            'pageSize' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
            'items' => $paginator->items()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Transaction::whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }
}

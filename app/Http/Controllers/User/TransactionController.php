<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\User\TransactionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    use TransactionTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->query()
            //->where('payer_uid', Auth::id())
            //->orWhere('payee_uid', Auth::id())
            ->filter($request->all())
            ->orderByDesc('transaction_id');

        return ajaxReturn([
            'total'=>$query->count(),
            'items'=>$query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->get()
        ]);
    }
}

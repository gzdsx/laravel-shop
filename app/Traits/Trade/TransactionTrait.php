<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-25
 * Time: 10:34
 */

namespace App\Traits\Trade;


use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait TransactionTrait
{
    /**
     * @return Transaction|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Transaction::withGlobalScope('owner', function (Builder $builder) {
            return $builder->where('payer_id', Auth::id())->orWhere('payee_id', Auth::id());
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showTransactions(Request $request)
    {
        $items = $this->repository()->orderByDesc('transaction_id')
            ->paginate($request->input('pagesize', 15));
        return $this->showTransactionsView($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showTransactionsView(Request $request, $items)
    {
        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $transaction = $this->repository()->find($request->input('transaction_id'));
        return jsonSuccess(compact('transaction'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->filter($request->all());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->take($request->input('count', 15))
                ->orderByDesc('transaction_id')->get()
        ]);
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

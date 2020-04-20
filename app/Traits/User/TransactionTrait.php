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

namespace App\Traits\User;


use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Http\Request;

trait TransactionTrait
{
    /**
     * @return Transaction|\Illuminate\Database\Eloquent\Builder
     */
    protected function query(){
        return Transaction::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showTransactions(Request $request)
    {
        $items = $this->query()->orderByDesc('transaction_id')
            ->paginate($request->input('perPage', 15));
        return $this->showTransactionsView($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showTransactionsView(Request $request, $items)
    {
        return ajaxReturn(['items' => $items]);
    }
}

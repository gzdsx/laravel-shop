<?php

namespace App\Http\Controllers\Api;


use App\Models\Transaction;
use App\Traits\User\TransactionTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    use TransactionTrait;

    /**
     * @return Builder
     */
    protected function repository()
    {
        return Transaction::withGlobalScope('mine', function (Builder $builder) {
            return $builder->where('payer_id', Auth::id())->orWhere('payee_id', Auth::id());
        });
    }
}

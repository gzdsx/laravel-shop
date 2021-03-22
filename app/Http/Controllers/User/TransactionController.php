<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Traits\User\TransactionTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    use TransactionTrait;

    protected function repository()
    {
        return Transaction::withGlobalScope('owner', function (Builder $builder) {
            return $builder->where('payer_uid', Auth::id())->orWhere('payee_uid', Auth::id());
        });
    }
}

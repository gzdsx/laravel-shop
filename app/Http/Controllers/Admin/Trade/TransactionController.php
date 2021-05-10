<?php

namespace App\Http\Controllers\Admin\Trade;


use App\Http\Controllers\Admin\BaseController;
use App\Models\Transaction;
use App\Traits\Trade\TransactionTrait;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use TransactionTrait;

    protected function repository()
    {
        return Transaction::query();
    }
}

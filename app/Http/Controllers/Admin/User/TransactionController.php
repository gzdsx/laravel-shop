<?php

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Models\UserTransaction;
use App\Traits\User\UserTransactionTrait;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use UserTransactionTrait;

    protected function repository()
    {
        return UserTransaction::query();
    }
}

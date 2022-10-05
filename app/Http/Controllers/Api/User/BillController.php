<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Api\BaseController;
use App\Models\UserTransaction;
use App\Traits\User\UserTransactionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends BaseController
{
    use UserTransactionTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|UserTransaction
     */
    protected function repository()
    {
        return Auth::user()->transactions();
    }
}

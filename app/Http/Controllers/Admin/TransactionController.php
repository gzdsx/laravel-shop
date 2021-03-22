<?php

namespace App\Http\Controllers\Admin;


use App\Traits\User\TransactionTrait;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use TransactionTrait;
}

<?php

namespace App\Http\Controllers\Api\Trade;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Trade\TransactionTrait;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use TransactionTrait;
}

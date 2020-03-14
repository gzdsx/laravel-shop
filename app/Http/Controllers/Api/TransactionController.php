<?php

namespace App\Http\Controllers\Api;

use App\Library\User\TransactionManagers;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    use TransactionManagers;
}

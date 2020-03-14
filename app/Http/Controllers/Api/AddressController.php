<?php

namespace App\Http\Controllers\Api;


use App\Traits\User\AddressTrait;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    use AddressTrait;
}

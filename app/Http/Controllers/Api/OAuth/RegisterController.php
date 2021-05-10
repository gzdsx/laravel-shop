<?php

namespace App\Http\Controllers\Api\OAuth;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Auth\UserRegister;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    use UserRegister;
}

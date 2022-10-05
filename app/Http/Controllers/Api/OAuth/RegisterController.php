<?php

namespace App\Http\Controllers\Api\OAuth;


use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Traits\Auth\UserRegister;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    use UserRegister;

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        $access_token = $user->createToken('app')->accessToken;
        return jsonSuccess([
            'access_token' => $access_token
        ]);
    }
}

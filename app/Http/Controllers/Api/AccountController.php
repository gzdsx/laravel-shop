<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['account' => Auth::user()->account]);
    }
}

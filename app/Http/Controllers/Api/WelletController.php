<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class WelletController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['wallet' => $this->user()->wallet]);
    }
}

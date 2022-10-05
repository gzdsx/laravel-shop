<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStat()
    {
        $stat = Auth::user()->stat()->firstOrCreate();
        return jsonSuccess(['stat' => $stat]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RefundReason;
use Illuminate\Http\Request;

class RefundReasonController extends BaseController
{
    /**
     * @param Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
        return ['items' => RefundReason::all()];
    }
}

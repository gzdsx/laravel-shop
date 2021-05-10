<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Api\BaseController;
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

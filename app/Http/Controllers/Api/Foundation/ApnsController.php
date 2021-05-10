<?php

namespace App\Http\Controllers\Api\Foundation;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class ApnsController extends BaseController
{
    public function jpush(Request $request){

        return jsonSuccess();
    }
}

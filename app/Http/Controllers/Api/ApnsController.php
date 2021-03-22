<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApnsController extends BaseController
{
    public function jpush(Request $request){

        return jsonSuccess();
    }
}

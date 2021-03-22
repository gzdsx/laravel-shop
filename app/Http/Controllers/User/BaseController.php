<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Order\SoldTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldController extends BaseController
{
    use SoldTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function ($req, $next) {
            if (!Auth::user()->isAdmin()) {
                abort(403);
            }

            return $next($req);
        });
    }
}

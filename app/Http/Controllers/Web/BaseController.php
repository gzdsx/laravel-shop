<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $navName = 'home';

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function ($request, $next) {
            view()->composer('layouts.default', function ($view) {
                return $view->with('navName', $this->navName);
            });

            return $next($request);
        });
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $uid = 0;
    protected $username = '';
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware(function (Request $req, $next){
            if (Auth::check()) {
                $this->uid = Auth::user()->uid;
                $this->username = Auth::user()->username;
            }
            return $next($req);
        });
    }
}

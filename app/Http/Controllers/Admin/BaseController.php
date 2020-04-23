<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function (Request $req, $next) {
            if (!Auth::check()) {
                return redirect()->to(admin_url('login?redirect=' . url()->current()));
            }
            if (session('adminid') !== Auth::id()) {
                Auth::logout();
                session()->forget('adminid');
                return redirect()->to(admin_url('login?redirect=' . url()->current()));
            }
            return $next($req);
        });
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $adminid = 0;
    protected $SysMessageView = 'admin.message';

    /**
     * BaseController constructor.
     * @param Request $request
     */
    function __construct(Request $request)
    {
        $this->middleware(function (Request $req, $next){
            if (!Auth::check()) {
                return redirect()->to(admin_url('login?redirect='.url()->current()));
            }
            $this->adminid = session()->get('adminid');
            if ($this->adminid !== Auth::id()) {
                Auth::logout();
                session()->forget('adminid');
                return redirect()->to(admin_url('login?redirect='.url()->current()));
            }
            return $next($req);
        });
    }
}

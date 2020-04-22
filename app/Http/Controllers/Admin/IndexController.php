<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $adminid = 0;

    /**
     * BaseController constructor.
     * @param Request $request
     */
    function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function (Request $req, $next) {
            if (!Auth::check()) {
                return redirect()->to(admin_url('login?redirect=' . url()->current()));
            }
            $this->adminid = session()->get('adminid');
            if ($this->adminid !== Auth::id()) {
                Auth::logout();
                session()->forget('adminid');
                return redirect()->to(admin_url('login?redirect=' . url()->current()));
            }
            return $next($req);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('admin.index');
    }
}

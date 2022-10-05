<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\WechatLogin;
use App\Traits\Auth\UserLogin;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use UserLogin, WechatDefaultConfig;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['redirect' => $request->input('redirect', url()->previous())]);
        return $this->view('auth.login');
    }

    /**
     * @param Request $request
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function appcode(Request $request)
    {

        if (!$basestr = session('basestr')) {
            $basestr = Str::uuid()->toString();
            session(['basestr' => $basestr]);
        }

        WechatLogin::firstOrCreate(['basestr' => $basestr]);
        return $this->miniProgram()->app_code->getQrCode('/pages/auth/chklogin?basestr=' . $basestr, 140);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chklogin(Request $request)
    {
        if ($basestr = session('basestr')) {
            $login = WechatLogin::where('basestr', $basestr)->first();
            if ($login) {
                if ($login->uid) {
                    Auth::loginUsingId($login->uid);
                    $login->delete();
                    return jsonSuccess(['user' => Auth::user()]);
                }
            }
        }

        return jsonSuccess();
    }
}

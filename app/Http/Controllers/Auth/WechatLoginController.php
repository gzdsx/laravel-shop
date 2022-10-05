<?php

namespace App\Http\Controllers\Auth;


use App\Models\WechatLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WechatLoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request)
    {
        $basestr = session('basestr');
        $wxlogin = WechatLogin::where('basestr', $basestr)->first();
        if ($wxlogin) {
            if ($wxlogin->uid && $wxlogin->openid) {
                Auth::loginUsingId($wxlogin->uid);
                session(['openid'=>$wxlogin->openid]);
                $wxlogin->delete();
                return jsonSuccess();
            }
        }

        return jsonError(401, 'unauthenticated!');
    }

    /**
     * @param Request $request
     * @return string|void
     */
    public function qrcode(Request $request)
    {
        $basestr = session('basestr');
        if (!$basestr) {
            $basestr = Str::uuid()->toString();
            session(['basestr' => $basestr]);
            WechatLogin::create(['basestr' => $basestr]);
        }

        return QrCode::format('png')->size(500)->generate(url('h5/login?basestr=' . $basestr));
    }
}

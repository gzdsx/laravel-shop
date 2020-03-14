<?php

namespace App\Http\Controllers\Api;

use App\Models\JPush;
use Illuminate\Http\Request;

class JpushController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //return ajaxReturn($request->all());
        $uid = $request->input('uid', 0);
        $appid = $request->input('appid', 0);
        $platform = $request->input('platform', 'ios');
        $registrationid = $request->input('registrationid', null);

        $jpush = null;
        if ($appid && $platform && $registrationid) {
            $jpush = JPush::where(compact('appid', 'platform', 'registrationid'))->first();
            if ($jpush) {
                if ($uid) {
                    $jpush->update(['uid' => $uid]);
                }
            } else {
                $jpush = JPush::where(compact('uid', 'appid', 'platform'))->first();
                if ($jpush) {
                    $jpush->update(['registrationid' => $registrationid]);
                } else {
                    $jpush = JPush::create(compact('uid', 'appid', 'platform', 'registrationid'));
                }
            }
        }

        return ajaxReturn(['jpush' => $jpush]);
    }
}

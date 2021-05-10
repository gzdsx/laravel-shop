<?php

namespace App\Http\Controllers\Api\Foundation;

use App\Aliyun\SmsClient;
use App\Http\Controllers\Api\BaseController;
use App\Models\Verify;
use Illuminate\Http\Request;

class SmsController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function sendCode(Request $request)
    {
        $mobile = $request->input('mobile');
        $code = $this->generateCode();
        $smsClient = new SmsClient();
        $smsClient->send($mobile, ['code' => $code]);

        Verify::create([
            'mobile' => $mobile,
            'code' => $code
        ]);
        return jsonSuccess();
    }

    /**
     * @param int $len
     * @return string
     */
    protected function generateCode($len = 6)
    {
        $code = '';
        $pattern = '1234567890';
        for ($i = 0; $i < $len; $i++) {
            $code .= $pattern[mt_rand(0, 9)];
        }

        return $code;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verify(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|string|mobile'
        ]);

        $mobile = $request->input('mobile');
        $verify = Verify::where('mobile', $mobile)->orderByDesc('id')->first();
        if (!$verify || $verify->code != $request->input('code')) {
            abort(500, '验证码错误');
        }
        return jsonSuccess();
    }
}

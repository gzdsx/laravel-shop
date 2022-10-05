<?php

namespace App\Http\Controllers\Api\Common;

use App\Aliyun\SmsClient;
use App\Http\Controllers\Api\BaseController;
use App\Models\UserVerify;
use App\QCloud\QSmsClient;
use Illuminate\Http\Request;
use TencentCloud\Common\Exception\TencentCloudSDKException;

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
        $code = $this->generateCode();
        $phone = $request->input('phone');
        //$smsClient = new SmsClient();
        //$smsClient->send($phone, ['code' => $code]);

        try {
            $client = new QSmsClient();
            $client->send(['+86' . $phone], [$code]);

            UserVerify::create([
                'phone' => $phone,
                'code' => $code
            ]);

            return jsonSuccess();
        } catch (TencentCloudSDKException $exception) {
            return jsonError($exception->getCode(), $exception->getMessage());
        }
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
            'phone' => 'required|string|mobile'
        ]);

        $phone = $request->input('phone');
        $verify = UserVerify::where('phone', $phone)->orderByDesc('id')->first();
        if (!$verify || $verify->code != $request->input('code')) {
            abort(500, '验证码错误');
        } else {
            $verify->delete();
        }
        return jsonSuccess();
    }
}

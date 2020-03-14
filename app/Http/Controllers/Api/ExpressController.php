<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiRequestException;
use App\Models\Express;
use App\Models\OrderShipping;
use Illuminate\Http\Request;

class ExpressController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiRequestException
     */
    public function getExpress(Request $request)
    {
        $order_id = $request->input('order_id', 0);
        $shipping = OrderShipping::where('order_id', $order_id)->first();
        if ($shipping) {
            $data = cache()->remember('express_' . $order_id, 720, function () use ($shipping) {
                return json_decode($this->fetchExpressData($shipping->express_no), true);
            });
            return ajaxReturn($data);
        } else {
            throw new ApiRequestException('not exists', 404);
        }
    }

    /**
     * @param $express_no
     * @return bool|string
     */
    private function fetchExpressData($express_no)
    {
        //$express_no = '75127913120446';
        $host = "https://courier.market.alicloudapi.com";
        $path = "/courier";
        $method = "GET";
        $appcode = "aca8f0a30588448cba23686845ac8217";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "com=auto&no=" . $express_no;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $content = curl_exec($curl);
        $headSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $body = substr($content, $headSize);
        return $body;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $id = $request->input('id');
        $express = Express::find($id);
        return ajaxReturn(['express' => $express]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        return ajaxReturn(['items' => Express::all()]);
    }
}

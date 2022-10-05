<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2022 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2022/7/28
 * Time: 下午3:42
 */

namespace App\Traits\Lbs;


use GuzzleHttp\Client;
use Illuminate\Http\Request;

trait TMapTrait
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function geocoder(Request $request)
    {
        $client = new Client();
        if ($request->has('location')) {
            $query = '&location=' . $request->input('location');
        }

        if ($request->has('address')) {
            $query = '&address=' . $request->input('address');
        }

        $uri = 'https://apis.map.qq.com/ws/geocoder/v1/?key=' . env('TMAP_KEY') . $query;
        $response = $client->get($uri);

        $result = json_decode($response->getBody()->getContents(), true);
        if (isset($result['result'])) {
            return jsonSuccess($result['result']);
        } else {
            return jsonError(500, $result['message']);
        }
    }
}

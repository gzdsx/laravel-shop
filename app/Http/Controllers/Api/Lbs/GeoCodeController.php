<?php

namespace App\Http\Controllers\Api\Lbs;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GeoCodeController extends BaseController
{
    public function geo(Request $request)
    {
        $client = new Client();
        $response = $client->get('https://restapi.amap.com/v3/geocode/geo?parameters', [
            'query' => [
                'key' => env('AMAP_KEY'),
                'address' => $request->input('address')
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return jsonSuccess($result['geocodes'] ?? []);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function regeo(Request $request)
    {

        $client = new Client();
        $response = $client->get('https://restapi.amap.com/v3/geocode/regeo?parameters', [
            'query' => [
                'key' => env('AMAP_KEY'),
                'location' => $request->input('location'),
                'extensions' => $request->input('extensions', 'base'),
                'poitype'=>'商务住宅|科教文化服务|金融保险服务'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return jsonSuccess($result['regeocode'] ?? []);
    }
}

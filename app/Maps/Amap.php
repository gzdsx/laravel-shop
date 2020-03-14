<?php
/**
 * Created by PhpStorm.
 * User: songdewei
 * Date: 2017/9/23
 * Time: 上午9:33
 */

namespace App\Maps;

use App\Helpers\Http;

class Amap
{
    private $key = '';

    /**
     * Amap constructor.
     * @param $key
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    function __construct($key)
    {
        $this->key = $key ? $key : setting('amap.key');
    }

    /**
     * @param $key
     */
    public function setKey($key){
        $this->key = $key;
    }

    /**
     * 高德地理位置编码
     * @param $address
     * @param string $city
     * @param string $sig
     * @return array
     */
    public function geocode($address, $city='', $sig=''){
        $url = "http://restapi.amap.com/v3/geocode/geo?key=".$this->key."&s=rsv3&address=".$address."&city=".$city."&sig=$sig";
        $json  = Http::curlGet($url);
        $data  = json_decode($json,true);
        if ($data['status'] == 1){
            $info = $data['geocodes'][0];
            $coordinate = explode(',', $info['location']);
            $info['longitude'] = floatval($coordinate[0]);
            $info['latitude']  = floatval($coordinate[1]);
            return $info;
        } else {
            return array(
                'longitude'=>0,
                'latitude'=>0
            );
        }
    }

    /**
     * 高德逆地理位置编码
     * @param $lng
     * @param $lat
     * @return array
     */
    public function regeocode($lng, $lat){
        $lng = floatval($lng);
        $lat = floatval($lat);
        $location = $lng.','.$lat;
        $url = 'http://restapi.amap.com/v3/geocode/regeo?key='.$this->key.'&extensions=base&location='.$location;
        $json = Http::curlGet($url);
        $data = json_decode($json,true);
        if ($data['status'] == 1){
            $location = $data['regeocode']['addressComponent'];
            $location['longitude'] = $lng;
            $location['latitude'] = $lat;
            $location['formatted_address'] = $data['regeocode']['formatted_address'];
            return $location;
        }else {
            return array();
        }
    }

    /**
     * 根据IP地址定位地理位置
     * @param $ip
     * @return array
     */
    public function geocodeByIp($ip){
        if (is_null($ip)) $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'http://restapi.amap.com/v3/ip?key='.$this->key.'&ip='.$ip;
        $json = Http::curlGet($url);
        $data = json_decode($json,true);
        if ($data['status'] == 1){
            $position = explode(';', $data['rectangle']);
            $coords[0] = explode(',', $position[0]);
            $coords[1] = explode(',', $position[1]);
            $location = array(
                'ip'=>$ip,
                'province'=>$data['province'],
                'city'=>$data['city'],
                'longitude'=>($coords[0][0] + $coords[1][0])/2,
                'latitude'=>($coords[0][1] + $coords[1][1])/2
            );
            return $location;
        }else {
            return array();
        }
    }
}

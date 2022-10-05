<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-05-27
 * Time: 00:35
 */

namespace App\Support;


use GuzzleHttp\Client;

class VideoParser
{
    const URL_VILID = '/(youku\.com|v\.qq\.com)/';

    /**
     * @param string $url
     * @return VideoModel|bool
     */
    static function parse($url = '')
    {
        preg_match(self::URL_VILID, strtolower($url), $matches);
        switch ($matches[1]) {
            case 'youku.com' :
                $data = self::_youku($url);
                break;
            case 'v.qq.com':
                $data = self::_qq($url);
                break;
            default:
                $data = false;
        }
        return $data;
    }

    /**
     * @param $url
     * @return VideoModel|bool
     */
    public static function _youku($url)
    {
        preg_match('/id\_(\w+)[\=|\.html]/', $url, $matches);
        $link = "https://openapi.youku.com/v2/videos/show_basic.json?video_id={$matches[1]}&client_id=3d01f04416cbe807";

        $client = new Client();
        $json = $client->get($link)->getBody()->getContents();
        if ($json) {
            $array = json_decode($json, true);
            $video = new VideoModel();
            $video->img = $array['thumbnail'];
            $video->tit = $array['title'];
            $video->url = $array['link'];
            $video->swf = $array['player'];
            $video->vid = $array['id'];
            $video->des = $array['description'];
            return $video;
        } else {
            return false;
        }
    }


    /**
     * @param $url
     * @return VideoModel|bool
     */
    public static function _qq($url)
    {
        preg_match('/\/([a-zA-Z0-9]+)\.html/', $url, $matches);
        if (isset($matches[1])) {
            $vid = $matches[1];
            $link = 'http://vv.video.qq.com/getinfo?otype=xml&vids=' . $vid;
            $client = new Client();
            $xml = $client->get($link)->getBody()->getContents();
            //将XML转为array
            $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            if (isset($data['vl']['vi']['ti'])) {
                $video = new VideoModel();
                $video->vid = $vid;
                $video->url = $url;
                $video->tit = $data['vl']['vi']['ti'];
                $video->img = 'http://vpic.video.qq.com/' . date('mdHi') . '/' . $vid . '_160_90_3.jpg';
                $video->swf = 'http://static.video.qq.com/TPout.swf?vid=' . $vid;
                return $video;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/5/31
 * Time: 下午4:29
 */

use App\Repositories\Contracts\SettingsRepositoryInterface;
use Illuminate\Support\HtmlString;

if (!function_exists('setting')) {
    /**
     * @param null $name
     * @param string $value
     * @return \Illuminate\Support\Collection|mixed|string|null
     */
    function setting($name = null, $value = '')
    {
        try {
            static $_settings;
            if (!$_settings) $_settings = app(SettingsRepositoryInterface::class)->fetchFromCache();
            if (is_null($name)) {
                return $_settings;
            } else {
                if ($value === '') {
                    return $_settings->get($name);
                } elseif (is_null($value)) {
                    return $_settings->forget($name);
                } else {
                    $_settings->put($name, $value);
                    return $value;
                }
            }
        } catch (Exception $exception) {
            return null;
        }
    }
}

/**
 * @param $str
 * @param $length
 * @param string $dot
 * @return string
 */
function mbsubstr($str, $length, $dot = '...')
{
    if (mb_strlen($str) <= $length) {
        return $str;
    } else {
        return mb_substr($str, 0, $length - strlen($dot)) . $dot;
    }
}

/**
 * 计算两点之间的距离
 * @param $lat1
 * @param $lng1
 * @param $lat2
 * @param $lng2
 * @return float
 */
function distance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6377830;
    $lat1 = ($lat1 * pi()) / 180;
    $lng1 = ($lng1 * pi()) / 180;

    $lat2 = ($lat2 * pi()) / 180;
    $lng2 = ($lng2 * pi()) / 180;

    $calcLongitude = $lng2 - $lng1;
    $calcLatitude = $lat2 - $lat1;
    $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
    $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;
    return round($calculatedDistance);
}

/**
 * 格式化距离
 * @param string $distance
 * @return string
 */
function format_distance($distance)
{
    if (!$distance) return '';
    if ($distance < 1000) {
        return $distance . 'm';
    } else {
        return number_format($distance / 1000, 2) . 'km';
    }
}

/**
 * 16位MD5散列值
 * @param $str
 * @return string
 */
function md5_16($str)
{
    return substr(md5($str), 0, 16);
}

/**
 * 去除HTML代码和空格
 * @param string $str
 * @return mixed
 */
function strip_html($str)
{
    $str = strip_tags($str);
    $str = str_replace('&amp;', '&', $str);
    $str = str_replace(array('&ldquo;', '&rdquo;'), array('“', '”'), $str);
    $str = preg_replace('/\s|\n\r|　/', '', $str);
    return $str;
}

/**
 * 打印数组
 * @param mixed $array
 */
function print_array($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * 格式化文件尺寸
 * @param number $size
 * @return string
 */
function format_size($size)
{
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    if ($size == 0) {
        return ('n/a');
    } else {
        return (round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
    }
}

/**
 * @param $money
 * @return string
 */
function format_amount($money)
{
    return number_format($money, 2, '.', '');
}

/**
 * 清除文档格式
 */
function clean_style($str)
{
    $str = preg_replace('/\s*mso-[^:]+:[^;"]+;?/i', "", $str);
    $str = preg_replace('/\s*margin(.*?)pt\s*;/i', "", $str);
    $str = preg_replace('/\s*margin(.*?)cm\s*;/i', "", $str);
    $str = preg_replace('/\s*text-indent:(.*?)\s*;/i', "", $str);
    $str = preg_replace('/\s*line-height:(.*?)\s*;/i', "", $str);
    $str = preg_replace('/\s*page-break-before: [^\s;]+;?"/i', "", $str);
    $str = preg_replace('/\s*font-variant: [^\s;]+;?"/i', "", $str);
    $str = preg_replace('/\s*tab-stops:[^;"]*;?/i', "", $str);
    $str = preg_replace('/\s*tab-stops:[^"]*/i', "", $str);
    $str = preg_replace('/\s*face="[^"]*"/i', "", $str);
    $str = preg_replace('/\s*face=[^ >]*/i', "", $str);
    $str = preg_replace('/\s*font:(.*?);/i', "", $str);
    $str = preg_replace('/\s*font-size:(.*?);/i', "", $str);
    $str = preg_replace('/\s*font-weight:(.*?);/i', "", $str);
    $str = preg_replace('/\s*font-family:[^;"]*;?/i', "", $str);
    $str = preg_replace('/<span style="Times New Roman&quot;">\s\n<\/span>/i', "", $str);
    return $str;
}

/**
 * 选择图片
 * @param $imgFile
 * @return bool
 */
function remove_exif($imgFile)
{
    if (!function_exists('exif_read_data')) {
        return false;
    }
    $img = @imagecreatefromjpeg($imgFile);
    if ($img === false) {
        return false;
    }
    $exif = @exif_read_data($imgFile);
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 8:
                $image = imagerotate($img, 90, 0);
                break;
            case 3:
                $image = imagerotate($img, 180, 0);
                break;
            case 6:
                $image = imagerotate($img, -90, 0);
                break;
        }
    }
    imagedestroy($img);
    if (isset($image)) {
        imagejpeg($image, $imgFile);
        imagedestroy($image);
    }
    return true;
}

/**
 * @param array $params
 * @return array
 */
function editor_params($params = [])
{
    $defaults = [
        '_token' => csrf_token()
    ];

    if (is_array($params)) {
        foreach ($params as $key => $value) {
            $defaults[$key] = $value;
        }
    }
    return $defaults;
}

/**
 * @param string $path
 * @return string
 */
function material_path($path = '')
{
    return \Illuminate\Support\Facades\Storage::path($path);
}

/**
 * @param $path
 * @return string
 */
function material_url($filename = '')
{
    if (preg_match("/([http|https|ftp]\:\/\/)(.*?)/is", $filename)) {
        return $filename;
    }
    return \Illuminate\Support\Facades\Storage::url($filename);
}

/**
 * @param $path
 * @return string
 */
function image_url($path = '')
{
    if (preg_match("/([http|https|ftp]\:\/\/)(.*?)/is", $path)) {
        return $path;
    }

    if (is_file(material_path($path))) {
        return material_url($path);
    } else {
        return asset('images/common/nopic.png');
    }
}

/**
 * @param $url
 * @return string|string[]
 */
function strip_image_url($url)
{
    return $url ? str_replace(material_url(), '', $url) : $url;
}

/**
 * @param $uid
 * @param string $size
 * @return string
 */
function avatar($uid, $size = 'big')
{
    $code = base64_encode(serialize(['uid' => $uid, 'size' => $size]));
    return url('avatar/' . $code);
}

/**
 * @param $pageid
 * @return string
 */
function page_url($pageid)
{
    return url('pages/detail/' . $pageid . '.html');
}

/**
 * @param $path
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function admin_url($path = '')
{
    return url('admin/' . trim($path, '/'));
}

/**
 * @param $priv
 * @return bool
 */
function admin_has_priv($priv)
{
    if (auth()->id() == 1000000) {
        return true;
    }

    return true;
    $privileges = session()->get('adminprivileges', []);
    return in_array($priv, $privileges);
}

/**
 * @param array $data
 * @return \Illuminate\Http\JsonResponse
 */
function ajaxReturn(array $data = [])
{
    $return = [
        'return_code' => 0,
        'return_msg' => 'SUCCESS'
    ];

    if (is_array($data) && !empty($data)) {
        $return = array_merge($return, $data);
    }
    return response()->json($return);
}

/**
 * @param int $errcode
 * @param string $errmsg
 * @param null $data
 * @return \Illuminate\Http\JsonResponse
 */
function ajaxError(int $errcode, string $errmsg, $data = null)
{
    $return = [
        'errcode' => $errcode,
        'errmsg' => $errmsg
    ];
    if (is_array($data) && !empty($data)) {
        $return = array_merge($return, $data);
    }
    return response()->json($return);
}

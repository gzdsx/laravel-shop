<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

/**
 * @return int|mixed
 */
function appversion()
{
    return env('APP_DEBUG') ? time() : env('APP_VERSION', 1.0);
}

/**
 * @param null $name
 * @param string $value
 * @return bool|\Illuminate\Contracts\Cache\Repository|mixed|string|null
 */
function settings($name = null, $value = '')
{
    static $_settings;
    try {
        if (!$_settings) {
            $_settings = collect(cache('settings', []));
        }
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

/**
 * @param $str
 * @param $length
 * @param string $dot
 * @return string
 */
function mbsubstr($str, $length, $dot = '...')
{
    if (mb_strlen($str) <= $length) return $str;
    return mb_substr($str, 0, $length - strlen($dot)) . $dot;
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
 * @param $count
 * @return string
 */
function format_count($count)
{
    if ($count > 10000) {
        return round($count / 10000, 2) . 'w';
    } else {
        return $count;
    }
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
 * @param string $path
 * @return string
 */
function material_path($path = '')
{
    return Storage::path($path);
}

/**
 * @param string $path
 * @return string
 */
function material_url($path = '')
{
    if (URL::isValidUrl($path)) return $path;
    return Storage::url($path);
}

/**
 * @param $path
 * @return string
 */
function image_url($path = '')
{
    if (URL::isValidUrl($path)) {
        return $path;
    }

    if (Storage::exists($path)) {
        return material_url($path);
    }

    return asset('images/common/nopic.png');
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
//    $privileges = session()->get('adminprivileges', []);
//    return in_array($priv, $privileges);
}

/**
 * @return bool
 */
function is_wechat()
{
    return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
}

/**
 * @param $id
 * @return mixed
 * @throws \Psr\SimpleCache\InvalidArgumentException
 */
function label($id)
{
    return cache()->get('labels', collect())->get($id);
}

/**
 * @param array $result
 * @param string $description
 * @return \Illuminate\Http\JsonResponse
 */
function jsonSuccess($result = [], $description = '')
{
    return response()->json([
        'result' => $result,
        'status' => [
            'code' => 0,
            'message' => 'ok',
            'description' => $description
        ]
    ]);
}

/**
 * @param int $errCode
 * @param string $errMsg
 * @param null $extra
 * @return \Illuminate\Http\JsonResponse
 */
function jsonError(int $errCode, string $errMsg, $extra = null)
{
    $return = [
        'errCode' => $errCode,
        'errMsg' => $errMsg,
    ];
    if ($extra) $return['extra'] = $extra;
    return response()->json($return);
}

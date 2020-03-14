<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-03
 * Time: 19:52
 */

namespace App\Traits\Wechat;


use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;

trait SyncWechatHeadImg
{
    /**
     * 同步头像
     * @param $uid
     * @param $uri
     * @return bool
     */
    protected function downloadWechatHeadImg($uid, $uri)
    {
        ignore_user_abort(true);
        $client = new Client();
        $response = $client->get($uri);
        $handle = Image::make($response->getBody());
        $avatarPath = material_path('avatar/' . $uid);
        @mkdir($avatarPath, 0777, true);
        $handle->resize(300, 300)->save($avatarPath . '/big.png');
        $handle->resize(150, 150)->save($avatarPath . '/middle.png');
        $handle->resize(50, 50)->save($avatarPath . '/small.png');
        return true;
    }
}

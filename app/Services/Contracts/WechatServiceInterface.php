<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-22
 * Time: 23:22
 */

namespace App\Services\Contracts;


interface WechatServiceInterface
{
    /**
     * @param array $userInfo
     * @return \App\Models\User
     */
    public function register($userInfo);
}

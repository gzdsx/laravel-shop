<?php

use JPush\Client as JPush;

/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/7/9
 * Time: 下午4:56
 */

function appPush()
{
    return new JPush('8bef43e2c8de2cb913303bf7', 'fef6965d59bb60c887611ae3', null, null);
}

function selerAppPush() {
    return new JPush('fff31542bcb7a21935c13471', '79eae1b8bf2d8acbe5d31900', null, null);
}

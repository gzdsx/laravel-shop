<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/11/22
 * Time: 11:43 AM
 */

function post_detail_url($aid)
{
    return url('post/detail/'.$aid.'.html');
}

/**
 * @param $aid
 * @return string
 */
function post_url($aid)
{
    return url('post/detail/'.$aid.'.html');
}

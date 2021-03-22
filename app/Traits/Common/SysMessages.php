<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/11/6
 * Time: 5:33 PM
 */

namespace App\Traits\Common;


trait SysMessages
{
    protected $SysMessageView = 'common.message';

    /**
     * @return SysMessager
     */
    protected function messager()
    {
        $messager = new SysMessager();
        return $messager->appends($this->data)->setView($this->SysMessageView);
    }
}

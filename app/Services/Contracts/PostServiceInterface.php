<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-21
 * Time: 15:18
 */

namespace App\Services\Contracts;


interface PostServiceInterface
{
    /**
     * @param $aid
     * @return \App\Models\PostItem
     */
    public function find($aid);
    /**
     * @param array $attributes
     * @return \App\Models\PostItem
     */
    public function update(array $attributes);

}

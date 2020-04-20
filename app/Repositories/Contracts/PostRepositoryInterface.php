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
 * Time: 15:15
 */

namespace App\Repositories\Contracts;


interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * @return \App\Models\PostItem|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query();

    /**
     * @param array $attributes
     * @return @return \App\Models\PostItem
     */
    public function store(array $attributes);
}

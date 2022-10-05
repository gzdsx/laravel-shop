<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/20
 * Time: 5:37 下午
 */

namespace App\Traits\Post;


use App\Models\PostCategory;
use App\Traits\Common\CategoryTrait;
use Illuminate\Http\Request;

trait PostCategoryTrait
{
    use CategoryTrait;

    /**
     * @return PostCategory|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return PostCategory::query();
    }

    /**
     * 更新缓存
     */
    protected function updateCache()
    {
        PostCategory::updateCache();
    }
}

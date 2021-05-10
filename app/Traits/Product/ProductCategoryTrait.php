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
 * Time: 5:25 下午
 */

namespace App\Traits\Product;


use App\Models\ProductCategory;
use App\Traits\Foundation\CategoryTrait;
use Illuminate\Http\Request;

trait ProductCategoryTrait
{
    use CategoryTrait;

    /**
     * @return ProductCategory|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return ProductCategory::query();
    }

    protected function updateCache()
    {
        ProductCategory::updateCache();
    }
}

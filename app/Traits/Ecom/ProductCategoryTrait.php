<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/5/9
 * Time: 08:04
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductCategory;
use App\Traits\Common\CategoryTrait;
use Illuminate\Database\Eloquent\Builder;

trait ProductCategoryTrait
{
    use CategoryTrait;

    /**
     * @return Builder
     */
    protected function repository()
    {
        // TODO: Implement repository() method.
        return EcomProductCategory::withGlobalScope('filter', function (Builder $builder) {
            return $builder->where('available', 1);
        });
    }
}

<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/3/16
 * Time: 05:21
 */

namespace App\Models\Traits;


use App\Models\ProductCollect;
use App\Models\ProductItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserHasProducts
{
    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(ProductItem::class, 'uid', 'uid');
    }

    /**
     * @return HasMany
     */
    public function productCollects()
    {
        return $this->hasMany(ProductCollect::class, 'uid', 'uid');
    }
}

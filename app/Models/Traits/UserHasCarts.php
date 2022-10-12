<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/12/20
 * Time: 08:10
 */

namespace App\Models\Traits;


use App\Models\EcomCart;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserHasCarts
{
    /**
     * @return HasMany
     */
    public function carts()
    {
        return $this->hasMany(EcomCart::class, 'uid', 'uid');
    }
}

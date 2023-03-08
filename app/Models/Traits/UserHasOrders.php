<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/3/20
 * Time: 18:38
 */

namespace App\Models\Traits;


use App\Models\Order;

trait UserHasOrders
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order
     */
    public function boughts()
    {
        return $this->hasMany(Order::class, 'buyer_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order
     */
    public function solds()
    {
        return $this->hasMany(Order::class, 'seller_id', 'uid');
    }
}

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


use App\Models\EcomCart;
use App\Models\EcomProductItem;
use App\Models\EcomShop;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserHasEcom
{
    /**
     * @return HasMany|EcomProductItem
     */
    public function products()
    {
        return $this->hasMany(EcomProductItem::class, 'seller_id', 'uid');
    }

    /**
     * @return BelongsToMany|EcomProductItem
     */
    public function collectedProducts()
    {
        return $this->belongsToMany(
            EcomProductItem::class,
            'ecom_product_collect_user',
            'collect_uid',
            'collect_itemid',
            'uid',
            'itemid'
        )->as('collect')->withTimestamps()->orderBy('ecom_product_collect_user.created_at', 'desc');
    }

    /**
     * @return HasOne|EcomShop
     */
    public function shop()
    {
        return $this->hasOne(EcomShop::class, 'seller_id', 'uid');
    }

    /**
     * @return BelongsToMany|EcomShop
     */
    public function subscribedShops()
    {
        return $this->belongsToMany(
            EcomShop::class,
            'ecom_shop_subscribe_user',
            'subscribed_uid',
            'subscribed_shop_id',
            'uid',
            'shop_id'
        )->as('subscribe')->withTimestamps();
    }

    /**
     * @return HasMany|EcomCart
     */
    public function cartProducts()
    {
        return $this->hasMany(EcomCart::class, 'uid', 'uid');
    }

    /**
     * @return HasMany|EcomCart
     */
    public function cartItems()
    {
        return $this->hasMany(EcomCart::class, 'uid', 'uid');
    }
}

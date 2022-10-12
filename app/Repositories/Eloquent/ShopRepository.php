<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-22
 * Time: 21:33
 */

namespace App\Repositories\Eloquent;


use App\Models\EcomShop;
use App\Repositories\Contracts\ShopRepositoryInterface;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return EcomShop::class;
    }

    /**
     * @param \App\Models\EcomShop $shop
     * @param $content
     * @return EcomShop
     */
    public function updateContent($shop, $content)
    {
        // TODO: Implement updateContent() method.
        if (is_array($content)) {
            $shop->content()->updateOrCreate([], $content);
        } else {
            $shop->content()->updateOrCreate([], ['content' => $content]);
        }
        return $shop;
    }

    /**
     * @param \App\Models\EcomShop $shop
     * @param array $auth
     * @return EcomShop
     */
    public function updateAuth($shop, array $auth)
    {
        // TODO: Implement updateAuth() method.
        if (is_array($auth)) {
            $shop->auth()->updateOrCreate([], $auth);
        }
        return $shop;
    }

    /**
     * @param \App\Models\EcomShop $shop
     * @param $uid
     * @return mixed
     */
    public function addCusotmer($shop, $uid)
    {
        // TODO: Implement addCusotmer() method.
        return $shop->customers()->updateOrCreate([], ['uid' => $uid]);
    }

    /**
     * @param EcomShop $shop
     * @param $id
     * @return mixed|void
     */
    public function removeCustomer($shop, $id)
    {
        // TODO: Implement removeCustomer() method.
        if (is_array($id)){
            $shop->customers()->whereKey($id)->delete();
        } else {
            $shop->customers()->where('id', $id)->delete();
        }

        return true;
    }
}

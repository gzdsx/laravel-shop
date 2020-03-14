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
 * Time: 21:32
 */

namespace App\Repositories\Contracts;


interface ShopRepositoryInterface extends RepositoryInterface
{
    /**
     * @param \App\Models\Shop $shop
     * @param $content
     * @return \App\Models\Shop
     */
    public function updateContent($shop, $content);

    /**
     * @param \App\Models\Shop $shop
     * @param array $auth
     * @return \App\Models\Shop
     */
    public function updateAuth($shop, array $auth);

    /**
     * @param \App\Models\Shop $shop
     * @param $uid
     * @return mixed
     */
    public function addCusotmer($shop, $uid);

    /**
     * @param \App\Models\Shop $shop
     * @param $id
     * @return mixed
     */
    public function removeCustomer($shop, $id);
}

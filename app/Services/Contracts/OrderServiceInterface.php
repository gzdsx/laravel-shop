<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 14:11
 */

namespace App\Services\Contracts;


use App\Models\Address;
use App\Models\Order;
use App\Models\Shop;

interface OrderServiceInterface
{
    /**
     * @param Shop $shop
     * @param array $items
     * @param Address $address
     * @param array $options
     * @return Order
     */
    public function create(Shop $shop, array $items, Address $address, $options = []);

    /**
     * @param Order $order
     * @return Order
     */
    public function paid(Order $order);

    /**
     * @param Order $order
     * @return Order
     */
    public function send(Order $order);

    /**
     * @param Order $order
     * @return Order
     */
    public function confirm(Order $order);

    /**
     * 买家评价
     * @param Order $order
     * @return Order
     */
    public function buyerReview(Order $order);

    /**
     * 卖家评价
     * @param Order $order
     * @return mixed
     */
    public function sellerReview(Order $order);

    /**
     * @param Order $order
     * @return Order
     */
    public function refunding(Order $order);

    /**
     * @param Order $order
     * @return Order
     */
    public function refund(Order $order);

    /**
     * @param Order $order
     * @return Order
     */
    public function close(Order $order);

    /**
     * @param Order $order
     * @return mixed
     */
    public function buyerDelete(Order $order);

    /**
     * @param Order $order
     * @return mixed
     */
    public function sellerDelete(Order $order);

}

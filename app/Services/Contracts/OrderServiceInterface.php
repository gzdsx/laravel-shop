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


use App\Models\Order;

interface OrderServiceInterface
{
    /**
     * @param array $items
     * @param array $address
     * @param array $options
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $items, $address, $coupon = null, $options = []);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function close(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function paid(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function notice(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function send(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function confirm(Order $order);

    /**
     * 买家评价
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function buyerRate(Order $order);

    /**
     * 卖家评价
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function sellerRate(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function buyerDelete(Order $order);

    /**
     * @param Order|\Illuminate\Database\Eloquent\Model $order
     * @return Order
     */
    public function sellerDelete(Order $order);

}

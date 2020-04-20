<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018-12-06
 * Time: 10:33
 */

return [
    'order manage' => '订单管理',
    'order list' => '订单列表',
    'order_states' => [
        '1' => '待付款',
        '2' => '待发货',
        '3' => '待确认',
        '4' => '交易成功',
        '5' => '退款中',
        '6' => '交易关闭',
    ],
    'buyer_order_states' => [
        '1' => '等待付款',
        '2' => '等待卖家发货',
        '3' => '卖家已发货',
        '4' => '交易成功',
        '5' => '退款中',
        '6' => '交易关闭'
    ],
    'seller_order_states' => [
        '1' => '等待买家付款',
        '2' => '等待发货',
        '3' => '已发货',
        '4' => '交易完成',
        '5' => '退款中',
        '6' => '交易关闭'
    ],
    'shipping type' => '配送方式',
    'shipping_types' => [
        '1' => '快递',
        '2' => '物流配送',
        '3' => '上门自取'
    ],
    'pay type' => '付款方式',
    'pay_types' => [
        '1' => '在线支付',
        '2' => '货到付款',
        '3' => '线下支付',
    ],
    'pay results' => '支付结果',
    'pay_states' => [
        '0' => '未支付',
        '1' => '已支付',
    ],
    'pay failed' => '付款失败',
    'pay success' => '支付成功',
    'order delete failed' => '订单删除失败',
    'order have been paid' => '订单已支付',
    'order does not exist' => '订单不存在',
    'order has been shipped' => '订单已发货，不能重复发货',
    'order shipped success' => '发货成功',
    'order cannot be closed' => '不能关闭此订单',
    'order cancel success' => '订单取消成功',
    'order refund submit success' => '你的退款申请已提交',
    'delivery success' => '发货成功',
    'confirm success' => '确认收货成功',
    'delete order' => '删除订单',
    'confirm receipt' => '确认收货',
];

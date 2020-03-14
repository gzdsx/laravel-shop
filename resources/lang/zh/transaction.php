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
    'transaction_states' => [
        '1' => '等待付款',
        '2' => '等待发货',
        '3' => '等待确认',
        '4' => '交易成功',
        '5' => '退款中',
        '6' => '交易关闭'
    ],
    'transaction_types'=>[
        'shopping'=>'购物',
        'charge'=>'缴费',
        'withdraw'=>'提现',
        'other'=>'其他'
    ],
    'pay_states' => [
        '0' => '未支付',
        '1' => '已支付'
    ],
    'pay_types'=>[
        '1'=>'余额支付',
        '2'=>'微信APP支付',
        '3'=>'微信小程序支付',
        '4'=>'微信公众号支付',
        '5'=>'支付宝支付'
    ],
    'transaction_subject_formater' => '%s等%d件商品',
    'close the transaction' => '关闭交易',
    'transaction details' => '交易明细',
    'transaction success' => '交易成功',
    'transaction closed' => '交易关闭',
    'transaction records do not exist' => '交易记录不存在'
];

<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/5/31
 * Time: 下午4:30
 */

/**
 * @param $shop_id
 * @return string
 */
function shop_url($shop_id) {
    return url('shop/viewshop/'.$shop_id.'.html');
}

/**
 * @param $itemid
 * @return string
 */
function item_url($itemid) {
    return url('item/detail/'.$itemid.'.html');
}

/**
 * @param $catid
 * @return string
 */
function item_catlog_url($catid) {
    return url('search?catid='.$catid);
}

/**
 * @param array $params
 * @return string
 */
function item_search_url($params = []) {
    return url('search?', http_build_query($params));
}

/**
 * @return string
 */
function createItemSn(){
    return time().rand(100,999).rand(100,999);
}

/**
 * 生成订单号
 * @param string $prefix
 * @return string
 */
function createOrderNo($prefix='6'){
    return $prefix.time().substr(microtime(), 2,6).rand(0,9);
}

/**
 * 生成交易流水号
 * @return string
 */
function createTransactionNo(){
    return date('YmdHis').rand(100,999).rand(100,999);
}

/**
 * @return string
 */
function createReundNo(){
    return '1'.time().rand(10,99).rand(100,999);
}

/**
 * @param $count
 * @return string
 */
function formatCount($count) {
    if ($count > 10000) {
        return round($count/10000, 2).'万';
    } else {
        return $count;
    }
}


/**
 * @param $path
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function seller_url($path = ''){
    return url('seller/'.$path);
}

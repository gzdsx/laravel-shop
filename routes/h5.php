<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/3/15
 * Time: 2:31 下午
 */

Route::group(['namespace' => 'H5'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('aboutus', 'IndexController@aboutus');
    //block
    Route::get('block/get', 'BlockController@getBlock');
    Route::get('block/batchget', 'Admin\BlockController@batchgetBlock');
    Route::get('block/item/get', 'BlockController@getItem');
    Route::get('block/item/batchget', 'BlockController@batchgetItem');
    //item
    Route::get('item/get', 'ItemController@get');
    Route::get('item/batchget', 'ItemController@batchget');
    Route::get('item/detail/{itemid}.html', 'ItemController@detail');

    Route::get('catlog', 'CatlogController@index');
    Route::get('catlog/batchget', 'CatlogController@batchget');
    Route::get('cart', 'CartController@index');
    Route::post('cart/add', 'CartController@add');
    Route::post('cart/delete', 'CartController@delete');

    Route::get('user', 'UserController@index');

    Route::get('order/buynow', 'OrderController@buynow');
    Route::post('order/create', 'OrderController@createOrder');
    Route::get('order/confirm', 'OrderController@confirm');
    Route::post('order/settlement', 'OrderController@settlement');

    Route::get('address', 'AddressController@index');
    Route::get('address/get', 'AddressController@get');
    Route::get('address/batchget', 'AddressController@batchget');
    Route::post('address/save', 'AddressController@store');
    Route::post('address/delete', 'AddressController@delete');

    Route::get('bought', 'BoughtController@index');
    Route::get('bought/detail', 'BoughtController@detail');
    Route::get('bought/get', 'BoughtController@get');
    Route::get('bought/batchget', 'BoughtController@batchget');

    Route::get('wechatpay/getconfig', 'WechatPayController@getConfig');

    Route::get('redpack/send', 'RedpackController@send');
    Route::get('feedback', 'FeedbackController@index');
    Route::post('feedback', 'FeedbackController@store');

    Route::get('trade/sold/order', 'SoldController@detail');
    Route::post('trade/sold/send', 'SoldController@send');

    Route::get('security', 'SecurityController@index');
    Route::post('security/password', 'SecurityController@store');
});

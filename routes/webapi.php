<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/16
 * Time: 11:09 下午
 */

Route::group(['namespace' => 'Api', 'prefix' => 'webapi'], function () {

    Route::get('item/get', 'ItemController@get');
    Route::get('item/batchget', 'ItemController@batchget');
    Route::get('item/catlog/get', 'ItemCatlogController@get');
    Route::get('item/catlog/getall', 'ItemCatlogController@getAll');
    Route::get('item/catlog/search', 'ItemCatlogController@search');

    //post
    Route::get('post/get', 'PostController@get');
    Route::get('post/batchget', 'PostController@batchget');
    Route::get('post/catlog/getall', 'PostCatlogController@getAll');
    //pages
    Route::get('pages/get', 'PagesController@get');
    Route::get('pages/batchget', 'PagesController@batchget');

    Route::get('district/get', 'DistrcitController@get');
    Route::get('district/batchget', 'DistrcitController@batchget');
    Route::get('user/get', 'UserController@get');
    Route::get('user/batchget', 'UserController@batchget');
    Route::get('block/get', 'BlockController@getBlock');
    Route::get('block/batchget', 'BlockController@batchgetBlock');
    Route::get('block/item/get', 'BlockController@getItem');
    Route::get('block/item/batchget', 'BlockController@batchgetItem');

    Route::get('express/getall', 'ExpressController@getAll');
    Route::get('refundreason/getall', 'RefundReasonController@getAll');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('freighttemplate/getall', 'FreightTemplateController@getAll');
        Route::get('material/get', 'MaterialController@get');
        Route::get('material/batchget', 'MaterialController@batchget');
        Route::post('material/delete', 'MaterialController@delete');
        Route::post('material/uploadimg', 'MaterialController@uploadImg');

        Route::get('address/get', 'AddressController@get');
        Route::get('address/batchget', 'AddressController@batchget');
        Route::post('address/delete', 'AddressController@delete');
        Route::post('address/update', 'AddressController@update');
        Route::post('address/setdefault', 'AddressController@setDefault');

        Route::get('order/buynow', 'OrderController@buynow');
        Route::post('order/create', 'OrderController@create');
        Route::get('order/confirm', 'OrderController@confirm');
        Route::post('order/settlement', 'OrderController@settlement');

        Route::get('cart/getall', 'CartController@getAll');
        Route::post('cart/create', 'CartController@create');
        Route::post('cart/update', 'CartController@update');
        Route::post('cart/delete', 'CartController@delete');
        Route::get('bought/get', 'BoughtController@get');
        Route::get('bought/batchget', 'BoughtController@batchget');
        Route::post('bought/close', 'BoughtController@close');
        Route::post('bought/confirm', 'BoughtController@confirm');
        Route::post('bought/delete', 'BoughtController@delete');
        Route::post('bought/notice', 'BoughtController@notice');
        Route::post('bought/applyrefund', 'BoughtController@applyRefund');

        Route::get('sold/get', 'SoldController@get');
        Route::get('sold/batchget', 'SoldController@batchget');
        Route::post('sold/editprice', 'SoldController@editPrice');
        Route::post('sold/send', 'SoldController@send');
        Route::get('transaction/batchget', 'TransactionController@batchget');
        Route::post('transaction/delete', 'TransactionController@delete');
        Route::get('wechatpay/getconfig', 'WechatPayController@getPayConfig');

        Route::get('kindeditor/manager', 'KindeditorController@manager');
        Route::post('kindeditor/upload', 'KindeditorController@upload');
    });
});

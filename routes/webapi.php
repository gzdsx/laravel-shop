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
    Route::post('item/update', 'ItemController@update');
    Route::post('item/delete', 'ItemController@delete');
    Route::get('item/catlog/get', 'ItemCatlogController@get');
    Route::get('item/catlog/getall', 'ItemCatlogController@getAll');
    Route::post('item/catlog/upgrade', 'ItemCatlogController@upgrade');
    Route::post('item/catlog/downgrade', 'ItemCatlogController@downgrade');
    Route::post('item/catlog/update', 'ItemCatlogController@update');
    Route::post('item/catlog/delete', 'ItemCatlogController@delete');
    Route::get('item/attrs/search','ItemController@searchAttrs');
    Route::get('item/attrs/delete','ItemController@deleteAttrs');
    Route::post('item/attrs/update','ItemController@updateAttrs');
    Route::get('freighttemplate/getall','FreightTemplateController@getAll');
    //post
    Route::get('post/get','PostController@get');
    Route::get('post/batchget','PostController@batchget');
    Route::post('post/update','PostController@update');
    Route::post('post/delete','PostController@batchDelete');
    Route::get('post/catlog/getall', 'PostCatlogController@getAll');
    Route::post('post/catlog/upgrade', 'PostCatlogController@upgrade');
    Route::post('post/catlog/downgrade', 'PostCatlogController@downgrade');
    Route::post('post/catlog/update', 'PostCatlogController@update');
    Route::post('post/catlog/delete', 'PostCatlogController@delete');
    //pages
    Route::get('pages/get','PagesController@get');
    Route::get('pages/batchget','PagesController@batchget');
    Route::post('pages/update','PagesController@update');
    Route::post('pages/delete','PagesController@delete');
    Route::get('pages/catlog/batchget','PagesController@batchgetCatlog');

    Route::get('material/get','MaterialController@get')->middleware('auth');
    Route::get('material/batchget','MaterialController@batchget')->middleware('auth');
    Route::post('material/delete','MaterialController@delete')->middleware('auth');
    Route::post('material/uploadimg','MaterialController@uploadImg')->middleware('auth');
    Route::get('link/get','LinkController@get');
    Route::get('link/batchget','LinkController@batchget');
    Route::post('link/update','LinkController@update');
    Route::post('link/delete','LinkController@delete');
    Route::get('district/get','DistrcitController@get');
    Route::get('district/batchget','DistrcitController@batchget');
    Route::get('user/get','UserController@get');
    Route::get('user/batchget','UserController@batchget');
    Route::get('settings/getall','SettingsController@getAll');
    Route::post('settings/update','SettingsController@update');
    Route::get('block/get','BlockController@getBlock');
    Route::get('block/batchget','BlockController@batchgetBlock');
    Route::get('block/item/get','BlockController@getItem');
    Route::get('block/item/batchget','BlockController@batchgetItem');
    Route::get('address/get','AddressController@get');
    Route::get('address/batchget','AddressController@batchget');
    Route::post('address/delete','AddressController@delete');
    Route::post('address/update','AddressController@update');
    Route::post('address/setdefault','AddressController@setDefault');

    Route::get('order/buynow', 'OrderController@buynow');
    Route::post('order/create', 'OrderController@create');
    Route::get('order/confirm', 'OrderController@confirm');
    Route::post('order/settlement', 'OrderController@settlement');

    Route::get('cart/getall','CartController@getAll');
    Route::post('cart/create','CartController@create');
    Route::post('cart/update','CartController@update');
    Route::get('bought/get', 'BoughtController@get');
    Route::get('bought/batchget', 'BoughtController@batchget');

    Route::get('wechatpay/getconfig','WechatPayController@getPayConfig');
});

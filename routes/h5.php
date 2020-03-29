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

    Route::get('user', 'UserController@index');

    Route::get('buynow', 'BuyController@buynow');

    Route::get('address', 'AddressController@index');
    Route::get('address/batchget', 'AddressController@batchget');
});

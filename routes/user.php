<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-04
 * Time: 19:44
 */

//个人中心
Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index');
    //Settings
    Route::get('userinfo', 'SettingsController@userinfo');
    Route::post('userinfo', 'SettingsController@saveInfo');
    Route::any('security', 'SettingsController@security');
    Route::post('bindmobile', 'SettingsController@bindMobile');
    Route::post('bindemail', 'SettingsController@bindEmail');
    Route::post('resetpass', 'SettingsController@resetPassword');
    Route::post('avatar', 'SettingsController@avatar');
    //Order
    Route::get('bought', 'BoughtController@index');
    //账单
    Route::get('transaction', 'TransactionController@index');
    //address
    Route::get('address', 'AddressController@index');
    Route::post('address/store', 'AddressController@store');
    Route::post('address/setdefault', 'AddressController@setDefault');
    Route::post('address/delete', 'AddressController@delete');
    Route::get('address/getaddress', 'AddressController@get');
    Route::get('address/getaddresslist', 'AddressController@batchget');
    Route::get('address/frame', 'AddressController@frame');
    //collect
    Route::get('collect', 'ItemCollectController@showCollectedItems');
    Route::get('collect/item', 'ItemCollectController@showCollectedItems');
    Route::post('collect/item/delete', 'ItemCollectController@delete');
    Route::get('collect/shop', 'CollectController@shop');
    Route::post('collect/shop/delete', 'CollectController@deleteShop');
    Route::get('collect/post', 'CollectController@post');
    Route::post('collect/post/delete', 'CollectController@deletePost');
});

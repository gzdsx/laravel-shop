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
    Route::get('info', 'UserController@info');
    Route::post('info/update', 'UserController@updateInfo');
    Route::post('avatar/update', 'UserController@updateAvatar');
    Route::post('security/update_mobile', 'SecurityController@updateMobile');
    Route::post('security/update_email', 'SecurityController@updateEmail');
    Route::post('security/update_password', 'SecurityController@updatePassword');
    //Order
    Route::get('bought/get', 'BoughtController@get');
    Route::get('bought/batchget', 'BoughtController@batchget');
    Route::post('bought/notice', 'BoughtController@notice');
    Route::post('bought/confirm', 'BoughtController@confirm');
    Route::post('bought/delete', 'BoughtController@delete');
    Route::post('bought/close', 'BoughtController@close');
    //账单
    Route::get('transaction/batchget', 'TransactionController@batchget');
    //address
    Route::get('address/get', 'AddressController@get');
    Route::get('address/batchget', 'AddressController@batchget');
    Route::post('address/update', 'AddressController@store');
    Route::post('address/setdefault', 'AddressController@setDefault');
    Route::post('address/delete', 'AddressController@delete');
    //collect
    Route::get('collect/post/batchget', 'CollectController@batchgetPosts');
    Route::post('collect/post/delete', 'CollectController@deletePost');
    Route::get('collect/item/batchget', 'CollectController@batchgetItems');
    Route::post('collect/item/delete', 'CollectController@deleteItem');
});

Route::get('avatar/{code}', 'User\AvatarController@index');

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
    Route::get('category', 'CategoryController@index');
    //item
    Route::get('item/{itemid}.html', 'ProductController@detail');
    Route::get('product/{itemid}.html', 'ProductController@detail');
    Route::get('product/search', 'ProductController@search');
    //video
    Route::get('video', 'VideoController@index');
    Route::get('video/{id}.html', 'VideoController@detail');
    //pages
    Route::get('page', 'PagesController@index');
    Route::get('page/{pageid}.html', 'PageController@detail');
    //post
    Route::get('post/{aid}.html', 'PostController@detail');


    Route::group(['middleware' => 'auth.h5'], function () {
        Route::get('cart', 'CartController@index');
        //order
        Route::get('order/buynow', 'OrderController@buynow');
        Route::post('order/confirm', 'OrderController@confirm');
        //sold
        Route::get('sold/detail', 'SoldController@detail');
        //user
        Route::get('user', 'UserController@index');
        //live
        Route::get('live', 'LiveController@index');
        Route::get('live/{id}', 'LiveController@detail');
        //login
        Route::get('login', 'LoginController@index');
        Route::get('login/confirm', 'LoginController@confirm');
        Route::get('login/cancel', 'LoginController@cancel');
    });
});

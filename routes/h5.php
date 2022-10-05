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

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'H5'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('category', 'CategoryController@index');
    //product
    Route::get('product', 'ProductController@index');
    Route::get('product/search', 'ProductController@search');
    Route::get('product/{itemid}.html', 'ProductController@detail');
    //video
    Route::get('video', 'VideoController@index');
    Route::get('video/{id}.html', 'VideoController@detail');
    //pages
    Route::get('page', 'PagesController@index');
    Route::get('page/{id}.html', 'PageController@detail');
    //post
    Route::get('post/{aid}.html', 'PostController@detail');


    Route::get('signin', 'SigninController@index')->name('signin');
    Route::post('signin', 'SigninController@login');
    Route::get('signout', 'SigninController@logout')->name('signout');
    Route::get('signup', 'SignupController@index')->name('signup');
    Route::post('signup', 'SignupController@register');

    Route::get('wechat/login', 'WechatController@login')->middleware('wechat.oauth');

    Route::group(['middleware' => 'auth.h5'], function () {
        Route::get('cart', 'CartController@index');
        //order
        Route::get('order', 'OrderController@index');
        Route::get('order/detail', 'OrderController@detail');
        Route::get('order/buynow', 'OrderController@buynow');
        Route::post('order/confirm', 'OrderController@confirm');
        //bought
        Route::get('bought', 'BoughtController@index');
        Route::get('bought/detail', 'BoughtController@detail');
        //sold
        Route::get('sold/detail', 'SoldController@detail');
        //user
        Route::get('user', 'UserController@index');
        //live
        Route::get('live', 'LiveController@index');
        Route::get('live/{id}', 'LiveController@detail')->where('id', '[0-9]+');
        Route::get('live/poster/{id}', 'LiveController@poster')->where('id', '[0-9]+');
        Route::get('live/invite/{code}', 'LiveController@invite');
        //login
        Route::get('login', 'LoginController@index');
        Route::get('login/confirm', 'LoginController@confirm');
        Route::get('login/cancel', 'LoginController@cancel');
    });
});

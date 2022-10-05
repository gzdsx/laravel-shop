<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/25
 * Time: 4:27 上午
 */


Route::group(['namespace' => 'Ecom'], function () {
    Route::get('shop', 'IndexController@index');
    Route::get('search', 'ProductController@search');

    Route::get('product/search', 'ProductController@search');
    Route::get('product/reviews', 'ProductController@reviews');
    Route::get('product/{itemid}.html', 'ProductController@detail');

    Route::group(['middleware' => 'auth'], function () {
        //order
        Route::any('order/buynow', 'OrderController@buynow');
        Route::any('order/confirm', 'OrderController@confirm');
        Route::get('order/pay', 'OrderController@pay');
        Route::get('order/pay/result', 'OrderController@payResult');
        Route::get('order/alipay', 'OrderController@alipay');
        Route::get('order/query/alipay', 'OrderController@alipayQuery');
        //cart
        Route::get('cart', 'CartController@index');
    });
});

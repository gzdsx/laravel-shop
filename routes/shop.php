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


Route::group(['namespace' => 'Shop'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('search', 'SearchController@index');

    Route::group(['prefix' => 'item'], function () {
        Route::get('search', 'SearchController@index');
        Route::get('detail/{itemid}.html', 'ItemController@detail');
    });

    Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {
        Route::any('buynow', 'OrderController@buynow');
        Route::get('pay', 'OrderController@pay');
        Route::get('success', 'OrderController@success');
        Route::get('alipay', 'OrderController@alipay');
    });
});



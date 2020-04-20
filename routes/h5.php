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
    Route::get('catlog', 'CatlogController@index');
    Route::get('cart', 'CartController@index');
    Route::get('user', 'UserController@index');
    Route::get('item/detail/{itemid}.html', 'ItemController@detail');
});

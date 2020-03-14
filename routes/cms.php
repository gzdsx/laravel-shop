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
 * Time: 19:43
 */

Route::group(['namespace' => 'Cms'], function () {
    Route::get('news', 'PostController@index');

    Route::group(['prefix' => 'post'], function () {
        Route::get('/list', 'PostController@index');
        Route::get('/detail/{aid}.html', 'PostController@detail');
    });
});

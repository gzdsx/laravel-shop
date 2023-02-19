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
    //page
    Route::get('page/{id}.html', 'PageController@detail');
    //post
    Route::get('post/{aid}.html', 'PostController@detail');
});

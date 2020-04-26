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
 * Time: 19:41
 */

//杂项
Route::group(['namespace' => 'Misc'], function () {
    Route::get('map/picker', 'MapController@index');
    Route::get('avatar/{code}', 'AvatarController@index');
    Route::get('district/get', 'DistrictContoller@get');
    Route::get('district/batchget', 'DistrictContoller@batchget');

    Route::get('kindeditor/manager', 'KindeditorController@manager');
    Route::post('kindeditor/upload', 'KindeditorController@upload');
});
//页面
Route::group(['namespace' => 'Pages', 'prefix' => 'pages'], function () {
    Route::get('detail/{pageid}.html', 'DetailController@index');
});

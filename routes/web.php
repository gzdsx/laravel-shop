<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';
require __DIR__.'/post.php';
require __DIR__.'/shop.php';
require __DIR__.'/webapi.php';
//首页
Route::get('/', 'Shop\IndexController@index');
Route::group(['namespace' => 'Home'], function () {
    Route::get('app', 'IndexController@app');
    Route::get('upgrade', 'UpgradeController@index');
    Route::any('test', 'TestController@index');
});

//页面
Route::group(['namespace' => 'Pages', 'prefix' => 'pages'], function () {
    Route::get('detail/{pageid}.html', 'DetailController@index');
});

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
require __DIR__.'/admin.php';
require __DIR__.'/misc.php';
require __DIR__.'/user.php';
require __DIR__.'/cms.php';
//首页
Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('upgrade', 'UpgradeController@index');
    Route::get('search', 'SearchController@index');
    Route::get('search/shop', 'SearchController@shop');
    Route::get('app', 'IndexController@app');
    Route::any('test', 'TestController@index');
});

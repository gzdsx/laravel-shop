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

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/post.php';
require __DIR__ . '/ecom.php';
require __DIR__ . '/live.php';
require __DIR__ . '/video.php';
//首页
Route::get('/', 'Ecom\IndexController@index');

//页面
Route::group(['namespace' => 'Page', 'prefix' => 'page'], function () {
    Route::get('{id}.html', 'IndexController@detail');
});

Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index');
});


Route::get('/test', 'Test\IndexController@index');

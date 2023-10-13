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

Route::namespace('Web')->group(function () {
    Route::get('/', 'PostController@index');

    Route::get('post/{cate?}', 'PostController@index')->where('cate', '[0-9]+');
    Route::get('post/{id}.html', 'PostController@show')->where('id', '[0-9]+');

    Route::get('shop', 'ShopController@index');
    Route::get('video', 'VideoController@index');
    Route::get('live', 'LiveController@index');
});

Route::get('table', 'Test\IndexController@table');
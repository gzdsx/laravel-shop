<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/24
 * Time: 1:32 上午
 */

//后台管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('/', 'IndexController@index');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    //商品管理
    Route::get('item/get', 'ItemController@get');
    Route::get('item/batchget', 'ItemController@batchget');
    Route::post('item/update', 'ItemController@update');
    Route::post('item/delete', 'ItemController@delete');
    Route::post('item/batchupdate', 'ItemController@batchUpdate');
    //商品分类
    Route::get('item/catlog/get', 'ItemCatlogController@get');
    Route::get('item/catlog/getall', 'ItemCatlogController@getAll');
    Route::get('item/catlog/search', 'ItemCatlogController@search');
    Route::post('item/catlog/upgrade', 'ItemCatlogController@upgrade');
    Route::post('item/catlog/downgrade', 'ItemCatlogController@downgrade');
    Route::post('item/catlog/update', 'ItemCatlogController@update');
    Route::post('item/catlog/delete', 'ItemCatlogController@delete');
    //商品属性
    Route::get('item/attrs/search', 'ItemAttrController@searchAttrs');
    Route::get('item/attrs/delete', 'ItemAttrController@deleteAttrs');
    Route::post('item/attrs/update', 'ItemAttrController@updateAttrs');
    //运费模板
    Route::get('freighttemplate/get', 'FreightTemplateController@get');
    Route::get('freighttemplate/getall', 'FreightTemplateController@getAll');
    Route::post('freighttemplate/delete', 'FreightTemplateController@delete');
    Route::post('freighttemplate/update', 'FreightTemplateController@update');
    //文章管理
    Route::get('post/get', 'PostController@get');
    Route::get('post/batchget', 'PostController@batchget');
    Route::post('post/update', 'PostController@update');
    Route::post('post/delete', 'PostController@delete');
    Route::post('post/batchupdate', 'PostController@batchUpdate');
    //文章分类
    Route::get('post/catlog/getall', 'PostCatlogController@getAll');
    Route::post('post/catlog/upgrade', 'PostCatlogController@upgrade');
    Route::post('post/catlog/downgrade', 'PostCatlogController@downgrade');
    Route::post('post/catlog/update', 'PostCatlogController@update');
    Route::post('post/catlog/delete', 'PostCatlogController@delete');
    //页面管理
    Route::get('pages/get', 'PagesController@get');
    Route::get('pages/batchget', 'PagesController@batchget');
    Route::post('pages/update', 'PagesController@update');
    Route::post('pages/delete', 'PagesController@delete');
    Route::get('pages/catlog/batchget', 'PagesController@batchgetCatlog');
    //素材管理
    Route::get('material/get', 'MaterialController@get');
    Route::get('material/batchget', 'MaterialController@batchget');
    Route::post('material/delete', 'MaterialController@delete');
    Route::post('material/uploadimg', 'MaterialController@uploadImg');
    //链接管理
    Route::get('link/get', 'LinkController@get');
    Route::get('link/batchget', 'LinkController@batchget');
    Route::post('link/update', 'LinkController@update');
    Route::post('link/delete', 'LinkController@delete');
    Route::get('district/get', 'DistrcitController@get');
    Route::get('district/batchget', 'DistrcitController@batchget');
    //用户管理
    Route::get('user/get', 'UserController@get');
    Route::get('user/batchget', 'UserController@batchget');
    Route::post('user/batchupdate', 'UserController@batchUpdate');
    //系统设置
    Route::get('settings/getall', 'SettingsController@getAll');
    Route::post('settings/update', 'SettingsController@update');
    //模块管理
    Route::get('block/get', 'BlockController@getBlock');
    Route::get('block/batchget', 'BlockController@batchgetBlock');
    Route::post('block/update', 'BlockController@update');
    Route::post('block/delete', 'BlockController@delete');
    Route::get('block/item/get', 'BlockController@getItem');
    Route::get('block/item/batchget', 'BlockController@batchgetItem');
    Route::post('block/item/update', 'BlockController@updateItem');
    Route::post('block/item/delete', 'BlockController@deleteItem');
    //订单管理
    Route::get('order/get', 'OrderController@get');
    Route::get('order/batchget', 'OrderController@batchget');
    Route::post('order/editprice', 'OrderController@editPrice');
    Route::post('order/send', 'OrderController@send');
    Route::post('order/delete', 'OrderController@forceDelete');
    //付款记录
    Route::get('transaction/batchget', 'TransactionController@batchget');
    Route::post('transaction/delete', 'TransactionController@delete');
    //快递管理
    Route::get('express/getall', 'ExpressController@getAll');
    Route::post('express/update', 'ExpressController@update');
    Route::post('express/delete', 'ExpressController@delete');
    //微信管理
    Route::get('wechat/menu/getall', 'WechatMenuController@getAll');
    Route::get('wechat/menu/getalltypes', 'WechatMenuController@getAllTypes');
    Route::post('wechat/menu/update', 'WechatMenuController@update');
    Route::post('wechat/menu/delete', 'WechatMenuController@delete');
    Route::post('wechat/menu/apply', 'WechatMenuController@apply');
    Route::get('wechat/material/get', 'WechatMaterialController@get');
    Route::get('wechat/material/batchget', 'WechatMaterialController@batchget');
    Route::post('wechat/material/delete', 'WechatMaterialController@delete');
    Route::get('wechat/material/viewimage', 'WechatMaterialController@viewImage');
    //广告管理
    Route::get('ad/get', 'AdController@get');
    Route::get('ad/batchget', 'AdController@batchget');
    Route::post('ad/update', 'AdController@update');
    Route::post('ad/delete', 'AdController@delete');
    Route::post('ad/batchupdate', 'AdController@batchUpdate');
    //视频
    Route::get('video/batchget','VideoController@batchGet');
    Route::post('video/update','VideoController@update');
    Route::post('video/delete','VideoController@delete');
});

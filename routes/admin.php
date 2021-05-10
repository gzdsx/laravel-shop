<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
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
    //首页
    Route::get('/', 'IndexController@index');
    //基础部分
    Route::group(['namespace' => 'Foundation'], function () {
        Route::get('login', 'LoginController@index');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout');
        //仪表板
        Route::get('dashboard/posts', 'DashboardController@posts');
        Route::get('dashboard/counts', 'DashboardController@counts');
        Route::get('dashboard/newuser', 'DashboardController@newuser');
        //系统设置
        Route::get('settings/getall', 'SettingsController@getAll');
        Route::post('settings/update', 'SettingsController@update');
        //素材管理
        Route::get('material/get', 'MaterialController@get');
        Route::get('material/batchget', 'MaterialController@batchget');
        Route::post('material/delete', 'MaterialController@delete');
        //广告管理
        Route::get('ad/get', 'AdController@get');
        Route::get('ad/batchget', 'AdController@batchget');
        Route::post('ad/save', 'AdController@save');
        Route::post('ad/delete', 'AdController@delete');
        Route::post('ad/batchupdate', 'AdController@batchUpdate');
        //自定义标签
        Route::get('label/get', 'LabelController@get');
        Route::get('label/batchget', 'LabelController@batchget');
        Route::post('label/delete', 'LabelController@delete');
        Route::post('label/save', 'LabelController@save');
        Route::post('label/batchupdate', 'LabelController@batchUpdate');
        //快递管理
        Route::get('express/getall', 'ExpressController@getAll');
        Route::post('express/save', 'ExpressController@save');
        Route::post('express/delete', 'ExpressController@delete');
        //链接管理
        Route::get('link/get', 'LinkController@get');
        Route::get('link/batchget', 'LinkController@batchget');
        Route::post('link/save', 'LinkController@save');
        Route::post('link/delete', 'LinkController@delete');
        //区域管理
        Route::get('district/get', 'DistrcitController@get');
        Route::get('district/batchget', 'DistrcitController@batchget');
        Route::post('district/save', 'DistrcitController@save');
        Route::post('district/delete', 'DistrcitController@delete');
        //模块管理
        Route::get('block/get', 'BlockController@get');
        Route::get('block/batchget', 'BlockController@batchget');
        Route::post('block/save', 'BlockController@save');
        Route::post('block/delete', 'BlockController@delete');
        Route::get('block/item/get', 'BlockItemController@get');
        Route::get('block/item/batchget', 'BlockItemController@batchget');
        Route::post('block/item/save', 'BlockItemController@save');
        Route::post('block/item/delete', 'BlockItemController@delete');
        //菜单管理
        Route::get('menu/get', 'MenuController@get');
        Route::get('menu/batchget', 'MenuController@batchget');
        Route::post('menu/save', 'MenuController@save');
        Route::post('menu/delete', 'MenuController@delete');
        Route::get('menu/item/get', 'MenuItemController@get');
        Route::get('menu/item/batchget', 'MenuItemController@batchget');
        Route::post('menu/item/save', 'MenuItemController@save');
        Route::post('menu/item/delete', 'MenuItemController@delete');

    });

    //用户管理
    Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
        //用户管理
        Route::get('get', 'UserController@get');
        Route::get('batchget', 'UserController@batchget');
        Route::post('save', 'UserController@save');
        Route::post('delete', 'UserController@delete');
        Route::post('batchupdate', 'UserController@batchUpdate');
        //分组管理
        Route::get('group/get', 'GroupController@get');
        Route::get('group/getall', 'GroupController@getAll');
        Route::post('group/save', 'GroupController@save');
        Route::post('group/delete', 'GroupController@delete');
    });

    //页面管理
    Route::group(['namespace' => 'Page', 'prefix' => 'page'], function () {
        //页面管理
        Route::get('get', 'PageController@get');
        Route::get('batchget', 'PageController@batchget');
        Route::post('save', 'PageController@save');
        Route::post('delete', 'PageController@delete');
        //页面分类
        Route::get('category/getall', 'CategoryController@getAll');
        Route::post('category/save', 'CategoryController@save');
        Route::post('category/delete', 'CategoryController@delete');
    });

    //门店管理
    Route::group(['namespace' => 'Shop'], function () {
        //运费模板
        Route::get('freighttemplate/get', 'FreightTemplateController@get');
        Route::get('freighttemplate/getall', 'FreightTemplateController@getAll');
        Route::post('freighttemplate/save', 'FreightTemplateController@save');
        Route::post('freighttemplate/delete', 'FreightTemplateController@delete');
        //退货理由
        Route::get('refundreason/getall', 'RefundReasonController@getAll');
        Route::post('refundreason/save', 'RefundReasonController@save');
        Route::post('refundreason/delete', 'RefundReasonController@delete');
        //退货地址
        Route::get('refundaddress/get', 'RefundAddressController@get');
        Route::get('refundaddress/batchget', 'RefundAddressController@batchget');
        Route::post('refundaddress/save', 'RefundAddressController@save');
        Route::post('refundaddress/delete', 'RefundAddressController@delete');
    });
    //产品管理
    Route::group(['namespace' => 'Product', 'prefix' => 'product'], function () {
        //商品管理
        Route::get('get', 'ProductController@get');
        Route::get('batchget', 'ProductController@batchget');
        Route::post('save', 'ProductController@save');
        Route::post('delete', 'ProductController@delete');
        Route::post('batchupdate', 'ProductController@batchUpdate');
        //产品分类
        Route::get('category/getall', 'CategoryController@getAll');
        Route::post('category/increase', 'CategoryController@increase');
        Route::post('category/decrease', 'CategoryController@decrease');
        Route::post('category/upgrade', 'CategoryController@upgrade');
        Route::post('category/save', 'CategoryController@save');
        Route::post('category/delete', 'CategoryController@delete');
        //商品属性
        Route::get('attrs/search', 'AttributeController@searchAttrs');
        Route::post('attrs/delete', 'AttributeController@deleteAttrs');
        Route::post('attrs/update', 'AttributeController@updateAttrs');
    });
    //文章管理
    Route::group(['namespace' => 'Post', 'prefix' => 'post'], function () {
        Route::get('get', 'PostController@get');
        Route::get('batchget', 'PostController@batchget');
        Route::post('save', 'PostController@save');
        Route::post('delete', 'PostController@delete');
        Route::post('batchupdate', 'PostController@batchUpdate');
        //文章分类
        Route::get('category/getall', 'CategoryController@getAll');
        Route::post('category/increase', 'CategoryController@increase');
        Route::post('category/decrease', 'CategoryController@decrease');
        Route::post('category/upgrade', 'CategoryController@upgrade');
        Route::post('category/save', 'CategoryController@save');
        Route::post('category/delete', 'CategoryController@delete');
    });
    //直播管理
    Route::group(['namespace' => 'Live', 'prefix' => 'live'], function () {
        Route::get('get', 'LiveController@get');
        Route::get('batchget', 'LiveController@batchget');
        Route::post('save', 'LiveController@save');
        Route::post('delete', 'LiveController@delete');
        Route::get('channel/getall', 'ChannelController@getAll');
        Route::post('channel/save', 'ChannelController@save');
        Route::post('channel/delete', 'ChannelController@delete');
        Route::get('admin/get', 'AdminController@get');
        Route::get('admin/getall', 'AdminController@getAll');
        Route::post('admin/save', 'AdminController@save');
        Route::post('admin/delete', 'AdminController@delete');
        Route::get('invite/batchget', 'InviteController@batchget');
        Route::post('invite/create', 'InviteController@create');
        Route::post('invite/delete', 'InviteController@delete');
        Route::get('invite/code/{id}', 'InviteController@code');
    });

    //视频管理
    Route::group(['namespace' => 'Video', 'prefix' => 'video'], function () {
        Route::get('batchget', 'VideoController@batchget');
        Route::post('save', 'VideoController@save');
        Route::post('delete', 'VideoController@delete');
    });

    //交易
    Route::group(['namespace' => 'Trade'], function () {
        //订单管理
        Route::get('order/get', 'OrderController@get');
        Route::get('order/batchget', 'OrderController@batchget');
        Route::post('order/adjustprice', 'OrderController@adjustPrice');
        Route::post('order/send', 'OrderController@send');
        Route::post('order/delete', 'OrderController@forceDelete');
        //退款管理
        Route::get('refund/get', 'RefundController@get');
        Route::get('refund/batchget', 'RefundController@batchget');
        Route::post('refund/delete', 'RefundController@delete');
        Route::post('refund/resolve', 'RefundController@resolve');
        Route::post('refund/reject', 'RefundController@reject');
        Route::post('refund/shipping/update', 'RefundController@updateShipping');
        //交易流水
        Route::get('transaction/batchget', 'TransactionController@batchget');
        Route::post('transaction/delete', 'TransactionController@delete');
    });

    //微信管理
    Route::group(['namespace' => 'Wechat', 'prefix' => 'wechat'], function () {
        Route::get('menu/getall', 'MenuController@getAll');
        Route::get('menu/gettypes', 'MenuController@getAllTypes');
        Route::post('menu/save', 'MenuController@save');
        Route::post('menu/delete', 'MenuController@delete');
        Route::post('menu/apply', 'MenuController@apply');
        Route::get('material/get', 'MaterialController@get');
        Route::get('material/batchget', 'MaterialController@batchget');
        Route::get('material/viewimage', 'MaterialController@viewImage');
        Route::post('material/delete', 'MaterialController@delete');
    });
});

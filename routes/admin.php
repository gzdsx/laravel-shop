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

use Illuminate\Support\Facades\Route;

//后台管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::get('/', 'IndexController@index');
    Route::get('dashboard/posts', 'DashboardController@posts');
    Route::get('dashboard/counts', 'DashboardController@counts');
    Route::get('dashboard/newuser', 'DashboardController@newuser');
    //商品管理
    Route::get('product/get', 'ProductController@get');
    Route::get('product/batchget', 'ProductController@batchget');
    Route::post('product/save', 'ProductController@save');
    Route::post('product/delete', 'ProductController@delete');
    Route::post('product/batchupdate', 'ProductController@batchUpdate');
    //商品分类
    Route::get('product/category/get', 'ProductCategoryController@get');
    Route::get('product/category/getall', 'ProductCategoryController@getAll');
    Route::get('product/category/search', 'ProductCategoryController@search');
    Route::post('product/category/increase', 'ProductCategoryController@increase');
    Route::post('product/category/decrease', 'ProductCategoryController@decrease');
    Route::post('product/category/upgrade', 'ProductCategoryController@upgrade');
    Route::post('product/category/save', 'ProductCategoryController@save');
    Route::post('product/category/delete', 'ProductCategoryController@delete');
    //商品属性
    Route::get('product/attrs/search', 'ProductAttrController@searchAttrs');
    Route::post('product/attrs/delete', 'ProductAttrController@deleteAttrs');
    Route::post('product/attrs/update', 'ProductAttrController@updateAttrs');
    //运费模板
    Route::get('freighttemplate/get', 'FreightTemplateController@get');
    Route::get('freighttemplate/getall', 'FreightTemplateController@getAll');
    Route::post('freighttemplate/save', 'FreightTemplateController@save');
    Route::post('freighttemplate/delete', 'FreightTemplateController@delete');
    //文章管理
    Route::get('post/get', 'PostController@get');
    Route::get('post/batchget', 'PostController@batchget');
    Route::post('post/save', 'PostController@save');
    Route::post('post/delete', 'PostController@delete');
    Route::post('post/batchupdate', 'PostController@batchUpdate');
    //文章分类
    Route::get('post/category/getall', 'PostCategoryController@getAll');
    Route::post('post/category/increase', 'PostCategoryController@increase');
    Route::post('post/category/decrease', 'PostCategoryController@decrease');
    Route::post('post/category/upgrade', 'PostCategoryController@upgrade');
    Route::post('post/category/save', 'PostCategoryController@save');
    Route::post('post/category/delete', 'PostCategoryController@delete');
    //页面管理
    Route::get('page/get', 'PageController@get');
    Route::get('page/batchget', 'PageController@batchget');
    Route::post('page/save', 'PageController@save');
    Route::post('page/delete', 'PageController@delete');
    //素材管理
    Route::get('material/get', 'MaterialController@get');
    Route::get('material/batchget', 'MaterialController@batchget');
    Route::post('material/delete', 'MaterialController@delete');
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
    //用户管理
    Route::get('user/get', 'UserController@get');
    Route::get('user/batchget', 'UserController@batchget');
    Route::post('user/save', 'UserController@save');
    Route::post('user/delete', 'UserController@delete');
    Route::post('user/batchupdate', 'UserController@batchUpdate');
    Route::get('user/group/get', 'UserGroupController@get');
    Route::get('user/group/getall', 'UserGroupController@getAll');
    Route::post('user/group/save', 'UserGroupController@save');
    Route::post('user/group/delete', 'UserGroupController@delete');
    //系统设置
    Route::get('settings/getall', 'SettingsController@getAll');
    Route::post('settings/update', 'SettingsController@update');
    //模块管理
    Route::get('block/get', 'BlockController@getBlock');
    Route::get('block/batchget', 'BlockController@batchgetBlock');
    Route::post('block/save', 'BlockController@saveBlock');
    Route::post('block/delete', 'BlockController@deleteBlock');
    Route::get('block/item/get', 'BlockController@getItem');
    Route::get('block/item/batchget', 'BlockController@batchgetItem');
    Route::post('block/item/save', 'BlockController@saveItem');
    Route::post('block/item/delete', 'BlockController@deleteItem');
    //订单管理
    Route::get('order/get', 'OrderController@get');
    Route::get('order/batchget', 'OrderController@batchget');
    Route::post('order/adjustprice', 'OrderController@adjustPrice');
    Route::post('order/send', 'OrderController@send');
    Route::post('order/delete', 'OrderController@forceDelete');
    //付款记录
    Route::get('transaction/batchget', 'TransactionController@batchget');
    Route::post('transaction/delete', 'TransactionController@delete');
    //快递管理
    Route::get('express/getall', 'ExpressController@getAll');
    Route::post('express/save', 'ExpressController@save');
    Route::post('express/delete', 'ExpressController@delete');
    //微信管理
    Route::get('wechat/menu/getall', 'WechatMenuController@getAll');
    Route::get('wechat/menu/gettypes', 'WechatMenuController@getAllTypes');
    Route::post('wechat/menu/save', 'WechatMenuController@save');
    Route::post('wechat/menu/delete', 'WechatMenuController@delete');
    Route::post('wechat/menu/apply', 'WechatMenuController@apply');
    Route::get('wechat/material/get', 'WechatMaterialController@get');
    Route::get('wechat/material/batchget', 'WechatMaterialController@batchget');
    Route::post('wechat/material/delete', 'WechatMaterialController@delete');
    Route::get('wechat/material/viewimage', 'WechatMaterialController@viewImage');
    //广告管理
    Route::get('ad/get', 'AdController@get');
    Route::get('ad/batchget', 'AdController@batchget');
    Route::post('ad/save', 'AdController@save');
    Route::post('ad/delete', 'AdController@delete');
    Route::post('ad/batchupdate', 'AdController@batchUpdate');
    //视频
    Route::get('video/batchget', 'VideoController@batchGet');
    Route::post('video/save', 'VideoController@save');
    Route::post('video/delete', 'VideoController@delete');
    //退货理由
    Route::get('refundreason/getall', 'RefundReasonController@getAll');
    Route::post('refundreason/save', 'RefundReasonController@save');
    Route::post('refundreason/delete', 'RefundReasonController@delete');
    //退款
    Route::get('refund/get', 'RefundController@get');
    Route::get('refund/batchget', 'RefundController@batchget');
    Route::post('refund/delete', 'RefundController@delete');
    Route::post('refund/resolve', 'RefundController@resolve');
    Route::post('refund/reject', 'RefundController@reject');
    Route::post('refund/shipping/update', 'RefundController@updateShipping');
    //退货地址
    Route::get('refund/address/get', 'RefundAddressController@get');
    Route::get('refund/address/batchget', 'RefundAddressController@batchget');
    Route::post('refund/address/save', 'RefundAddressController@save');
    Route::post('refund/address/delete', 'RefundAddressController@delete');
    //直播
    Route::get('live/get', 'LiveController@get');
    Route::get('live/batchget', 'LiveController@batchget');
    Route::post('live/save', 'LiveController@save');
    Route::post('live/delete', 'LiveController@delete');
    Route::get('live/channel/getall', 'LiveChannelController@getAll');
    Route::post('live/channel/save', 'LiveChannelController@save');
    Route::post('live/channel/delete', 'LiveChannelController@delete');
    Route::get('live/admin/get', 'LiveAdminController@get');
    Route::get('live/admin/getall', 'LiveAdminController@getAll');
    Route::post('live/admin/save', 'LiveAdminController@save');
    Route::post('live/admin/delete', 'LiveAdminController@delete');
    Route::get('live/invite/batchget', 'LiveInviteController@batchget');
    Route::post('live/invite/create', 'LiveInviteController@create');
    Route::post('live/invite/delete', 'LiveInviteController@delete');
    Route::get('live/invite/code/{id}', 'LiveInviteController@code');
    //自定义标签
    Route::get('label/get', 'LabelController@get');
    Route::get('label/batchget', 'LabelController@batchget');
    Route::post('label/delete', 'LabelController@delete');
    Route::post('label/save', 'LabelController@save');
    Route::post('label/batchupdate', 'LabelController@batchUpdate');
    //菜单管理
    Route::get('menu/get', 'MenuController@get');
    Route::get('menu/batchget', 'MenuController@batchget');
    Route::post('menu/save', 'MenuController@save');
    Route::post('menu/delete', 'MenuController@delete');
    Route::get('menu/item/get', 'MenuController@getItem');
    Route::get('menu/item/batchget', 'MenuController@batchgetItem');
    Route::post('menu/item/save', 'MenuController@saveItem');
    Route::post('menu/item/delete', 'MenuController@deleteItem');
});

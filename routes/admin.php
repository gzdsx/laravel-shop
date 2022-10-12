<?php/** * ============================================================================ * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved. * siteַ: https://www.gzdsx.cn * ============================================================================ * @author:     David Song<songdewei@163.com> * @version:    v1.0.0 * --------------------------------------------- * Date: 2020/4/24 * Time: 1:32 上午 *///后台管理Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {    //首页    Route::get('/', 'IndexController@index');    Route::group(['namespace' => 'Auth'], function () {        Route::get('login', 'LoginController@index');        Route::post('login', 'LoginController@login');        Route::get('logout', 'LoginController@logout');    });    //基础部分    Route::group(['namespace' => 'Common', 'prefix' => 'common'], function () {        //仪表板        Route::get('dashboard.stats', 'DashboardController@stats');        Route::get('dashboard.posts', 'DashboardController@posts');        Route::get('dashboard.newusers', 'DashboardController@newusers');        //系统设置        Route::get('setting.settings', 'SettingController@settings');        Route::post('setting.update', 'SettingController@update');        //素材管理        Route::get('material.getInfo', 'MaterialController@getInfo');        Route::get('material.getList', 'MaterialController@getList');        Route::post('material.upload', 'MaterialController@upload');        Route::post('material.batchDelete', 'MaterialController@batchDelete');        //广告管理        Route::get('ad.getInfo', 'AdController@getInfo');        Route::get('ad.getList', 'AdController@getList');        Route::post('ad.save', 'AdController@save');        Route::post('ad.batchDelete', 'AdController@batchDelete');        Route::post('ad.batchUpdate', 'AdController@batchUpdate');        //自定义标签        Route::get('label.getInfo', 'LabelController@getInfo');        Route::get('label.getList', 'LabelController@getList');        Route::post('label.save', 'LabelController@save');        Route::post('label.batchDelete', 'LabelController@batchDelete');        Route::post('label.batchUpdate', 'LabelController@batchUpdate');        //快递管理        Route::get('express.getList', 'ExpressController@getList');        Route::post('express.save', 'ExpressController@save');        Route::post('express.batchDelete', 'ExpressController@batchDelete');        //链接管理        Route::get('link.getInfo', 'LinkController@getInfo');        Route::get('link.getList', 'LinkController@getList');        Route::post('link.save', 'LinkController@save');        Route::post('link.batchDelete', 'LinkController@batchDelete');        Route::get('link.getCategoryList', 'LinkController@getCategoryList');        //区域管理        Route::get('district.getInfo', 'DistrcitController@getInfo');        Route::get('district.getList', 'DistrcitController@getList');        Route::post('district.save', 'DistrcitController@save');        Route::post('district.batchDelete', 'DistrcitController@batchDelete');        //模块管理        Route::get('block.getInfo', 'BlockController@getInfo');        Route::get('block.getList', 'BlockController@getList');        Route::post('block.save', 'BlockController@save');        Route::post('block.delete', 'BlockController@delete');        Route::post('block.item.save', 'BlockItemController@save');        Route::post('block.item.batchDelete', 'BlockItemController@batchDelete');        //菜单管理        Route::get('menu.getList', 'MenuController@getList');        Route::post('menu.save', 'MenuController@save');        Route::post('menu.batchDelete', 'MenuController@batchDelete');        //菜单项管理        Route::get('menu.item.getList', 'MenuItemController@getList');        Route::post('menu.item.save', 'MenuItemController@save');        Route::post('menu.item.toggle', 'MenuItemController@toggle');        Route::post('menu.item.batchDelete', 'MenuItemController@batchDelete');        //客服        Route::get('kefu.getList', 'KefuController@getList');        Route::post('kefu.save', 'KefuController@save');        Route::post('kefu.batchDelete', 'KefuController@batchDelete');    });    //用户管理    Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {        //用户管理        Route::get('user.getInfo', 'UserController@getInfo');        Route::get('user.getList', 'UserController@getList');        Route::post('user.save', 'UserController@save');        Route::post('user.batchDelete', 'UserController@batchDelete');        Route::post('user.batchUpdate', 'UserController@batchUpdate');        //分组管理        Route::get('group.getList', 'GroupController@getList');        Route::post('group.save', 'GroupController@save');        Route::post('group.batchDelete', 'GroupController@batchDelete');        //管理员管理        Route::get('admin.group.getList', 'AdminGroupController@getList');        Route::post('admin.group.save', 'AdminGroupController@save');        Route::post('admin.group.batchDelete', 'AdminGroupController@batchDelete');        Route::get('admin.user.getList', 'AdminUserController@getList');        Route::post('admin.user.save', 'AdminUserController@save');        Route::post('admin.user.batchDelete', 'AdminUserController@batchDelete');    });    //页面管理    Route::group(['namespace' => 'Page', 'prefix' => 'page'], function () {        //页面管理        Route::get('page.getInfo', 'PageController@getInfo');        Route::get('page.getList', 'PageController@getList');        Route::post('page.save', 'PageController@save');        Route::post('page.batchDelete', 'PageController@batchDelete');        //页面分类        Route::get('category.getList', 'CategoryController@getList');        Route::post('category.save', 'CategoryController@save');        Route::post('category.delete', 'CategoryController@delete');    });    //文章管理    Route::group(['namespace' => 'Post', 'prefix' => 'post'], function () {        Route::get('item.getInfo', 'ItemController@getInfo');        Route::get('item.getList', 'ItemController@getList');        Route::post('item.save', 'ItemController@save');        Route::post('item.batchDelete', 'ItemController@batchDelete');        Route::post('item.batchUpdate', 'ItemController@batchUpdate');        //文章分类        Route::get('category.getList', 'CategoryController@getList');        Route::post('category.save', 'CategoryController@save');        Route::post('category.delete', 'CategoryController@delete');        Route::post('category.increase', 'CategoryController@increase');        Route::post('category.decrease', 'CategoryController@decrease');        Route::post('category.upgrade', 'CategoryController@upgrade');    });    //直播管理    Route::group(['namespace' => 'Live', 'prefix' => 'live'], function () {        Route::get('info', 'LiveController@getInfo');        Route::get('list', 'LiveController@getList');        Route::post('save', 'LiveController@save');        Route::post('delete', 'LiveController@delete');        Route::get('channel.list', 'ChannelController@getList');        Route::post('channel.save', 'ChannelController@save');        Route::post('channel.delete', 'ChannelController@delete');        Route::get('admin.info', 'AdminController@getInfo');        Route::get('admin.list', 'AdminController@getList');        Route::post('admin.save', 'AdminController@save');        Route::post('admin.delete', 'AdminController@delete');        Route::get('invite.list', 'InviteController@getList');        Route::get('invite.code', 'InviteController@getCode');        Route::post('invite.create', 'InviteController@create');        Route::post('invite.delete', 'InviteController@delete');    });    //视频管理    Route::group(['namespace' => 'Video', 'prefix' => 'video'], function () {        Route::get('list', 'VideoController@getList');        Route::post('save', 'VideoController@save');        Route::post('delete', 'VideoController@delete');        Route::get('comment.list', 'CommentController@getList');        Route::post('comment.delete', 'CommentController@delete');    });    //交易    Route::group(['namespace' => 'Trade', 'prefix' => 'trade'], function () {        //订单管理        Route::get('order.info', 'OrderController@getInfo');        Route::get('order.list', 'OrderController@getList');        Route::post('order.send', 'OrderController@send');        Route::post('order.adjustprice', 'OrderController@adjustPrice');        Route::post('order.batchdelete', 'OrderController@batchDelete');        //退款管理        Route::get('refund.info', 'RefundController@getInfo');        Route::get('refund.list', 'RefundController@getList');        Route::post('refund.delete', 'RefundController@delete');        Route::post('refund.resolve', 'RefundController@resolve');        Route::post('refund.reject', 'RefundController@reject');        Route::post('refund.shipping/update', 'RefundController@updateShipping');        Route::get('refund.reason.list', 'RefundReasonController@getList');        Route::post('refund.reason.save', 'RefundReasonController@save');        Route::post('refund.reason.delete', 'RefundReasonController@delete');        //交易流水        Route::get('transaction.list', 'TransactionController@getList');        Route::post('transaction.batchdelete', 'TransactionController@batchDelete');    });    //微信管理    Route::group(['namespace' => 'Wechat', 'prefix' => 'wechat'], function () {        Route::get('menu.getList', 'MenuController@getList');        Route::get('menu.getTypes', 'MenuController@getTypes');        Route::post('menu.save', 'MenuController@save');        Route::post('menu.delete', 'MenuController@delete');        Route::post('menu.apply', 'MenuController@apply');        Route::get('material.getInfo', 'MaterialController@getInfo');        Route::get('material.getList', 'MaterialController@getList');        Route::get('material.image', 'MaterialController@image');        Route::post('material.batchDelete', 'MaterialController@batchDelete');    });    //电商    Route::group(['namespace' => 'Ecom', 'prefix' => 'ecom'], function () {        //商品管理        Route::get('product.getInfo', 'ProductItemController@getInfo');        Route::get('product.getList', 'ProductItemController@getList');        Route::post('product.save', 'ProductItemController@save');        Route::post('product.batchDelete', 'ProductItemController@batchDelete');        Route::post('product.batchUpdate', 'ProductItemController@batchUpdate');        Route::get('product.content.getInfo', 'ProductContentController@getInfo');        //商品分类        Route::get('product.category.getList', 'ProductCategoryController@getList');        Route::post('product.category.increase', 'ProductCategoryController@increase');        Route::post('product.category.decrease', 'ProductCategoryController@decrease');        Route::post('product.category.upgrade', 'ProductCategoryController@upgrade');        Route::post('product.category.save', 'ProductCategoryController@save');        Route::post('product.category.delete', 'ProductCategoryController@delete');        //商品属性        Route::get('product.attr.getInfo', 'ProductAttrController@getInfo');        Route::get('product.attr.getList', 'ProductAttrController@getList');        Route::post('product.attr.save', 'ProductAttrController@save');        Route::post('product.attr.delete', 'ProductAttrController@delete');        Route::post('product.attr.updateAttrValue', 'ProductAttrController@updateAttrValue');        Route::get('product.attrvalue.getList', 'ProductAttrValueController@getList');        Route::post('product.attrvalue.save', 'ProductAttrValueController@save');        Route::post('product.attrvalue.delete', 'ProductAttrValueController@delete');        //运费模板        Route::get('product.template.getInfo', 'ProductTemplateController@getInfo');        Route::get('product.template.getList', 'ProductTemplateController@getList');        Route::post('product.template.save', 'ProductTemplateController@save');        Route::post('product.template.delete', 'ProductTemplateController@delete');        //店铺管理        Route::get('shop.getInfo', 'ShopController@getInfo');        Route::get('shop.getList', 'ShopController@getList');        Route::post('shop.save', 'ShopController@save');        Route::post('shop.verify', 'ShopController@verify');        Route::post('shop.batchDelete', 'ShopController@batchDelete');        Route::post('shop.batchUpdate', 'ShopController@batchUpdate');        //退货地址        Route::get('refund/address/list', 'RefundAddressController@getList');        Route::post('refund/address/save', 'RefundAddressController@save');        Route::post('refund/address/delete', 'RefundAddressController@delete');        //退货理由        Route::get('refund/reason/list', 'RefundReasonController@getList');        Route::post('refund/reason/save', 'RefundReasonController@save');        Route::post('refund/reason/delete', 'RefundReasonController@delete');    });    //位置服务    Route::group(['namespace' => 'Lbs', 'prefix' => 'lbs'], function () {        Route::get('geocoder', 'LbsController@geocoder');    });});
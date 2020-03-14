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
 * Time: 19:40
 */

//后台管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::get('/', 'IndexController@index');
    Route::get('wellcome', 'IndexController@wellcome');
    //系统设置
    Route::get('settings/{type}', 'SettingsController@index');
    Route::post('settings', 'SettingsController@store');
    //用户管理
    Route::get('user', 'UserController@index');
    Route::post('user/delete', 'UserController@delete');
    Route::get('user/edit', 'UserController@edit');
    Route::post('user/edit', 'UserController@store');
    Route::post('user/batchupdate', 'UserController@batchUpdate');
    Route::get('usergroup', 'UserGroupController@index');
    Route::post('usergroup', 'UserGroupController@batchUpdate');
    Route::get('usergroup/privilege', 'UserGroupController@privilege');
    Route::post('usergroup/privilege', 'UserGroupController@savePrivilege');
    //菜单管理
    Route::get('menu', 'MenuController@index');
    Route::post('menu', 'MenuController@saveMenu');
    Route::get('menu/items', 'MenuController@items');
    //广告管理
    Route::get('ad', 'AdController@index');
    Route::get('ad/newad', 'AdController@newad');
    Route::post('ad/newad', 'AdController@saveAd');
    Route::post('ad/delete', 'AdController@batchDelete');
    Route::post('ad/enable', 'AdController@batchEnable');
    Route::post('ad/disable', 'AdController@batchDisable');
    //内容板块
    Route::get('block', 'BlockController@blocks');
    Route::post('block', 'BlockController@deleteBlocks');
    Route::get('block/get', 'BlockController@getBlock');
    Route::post('block/save', 'BlockController@saveBlock');
    Route::get('block/items', 'BlockController@blockItems');
    Route::post('block/items', 'BlockController@batchUpdateItems');
    Route::get('block/newitem', 'BlockController@newitem');
    Route::post('block/newitem', 'BlockController@saveItem');
    Route::post('block/setimage', 'BlockController@setImage');

    //文章管理
    Route::get('post', 'PostController@showPosts');
    Route::get('post/newpost', 'PostController@newpost');
    Route::post('post/newpost', 'PostController@store');
    Route::post('post/setimage', 'PostController@setImage');
    Route::post('post/batchdelete', 'PostController@batchDelete');
    Route::post('post/batchresolve', 'PostController@batchResolve');
    Route::post('post/batchreject', 'PostController@batchReject');
    Route::post('post/batchmove', 'PostController@batchMove');
    //文章分类管理
    Route::get('post/catlog', 'PostCatlogController@index');
    Route::post('post/catlog', 'PostCatlogController@batchUpdate');
    Route::get('post/catlog/newcatlog', 'PostCatlogController@newcatlog');
    Route::post('post/catlog/newcatlog', 'PostCatlogController@store');
    Route::get('post/catlog/delete', 'PostCatlogController@delete');
    Route::post('post/catlog/delete', 'PostCatlogController@execDelete');
    Route::get('post/catlog/merge', 'PostCatlogController@merge');
    Route::post('post/catlog/merge', 'PostCatlogController@execMerge');
    Route::post('post/catlog/seticon', 'PostCatlogController@setIcon');
    //商品管理
    Route::get('item', 'ItemController@index');
    Route::get('item/edit', 'ItemController@publish');
    Route::post('item/edit', 'ItemController@store');
    Route::post('item/batchdelete', 'ItemController@batchDelete');
    Route::post('item/batchonsale', 'ItemController@batchOnSale');
    Route::post('item/batchoffsale', 'ItemController@batchOffSale');
    Route::post('item/batchmove', 'ItemController@batchMove');
    Route::post('item/togglebest', 'ItemController@toggleBest');
    Route::get('item/reviews', 'ItemController@reviews');
    Route::post('item/delreviews', 'ItemController@delReviews');
    //商品分类
    Route::get('item/catlog', 'ItemCatlogController@index');
    Route::post('item/catlog', 'ItemCatlogController@batchUpdate');
    Route::get('item/catlog/newcatlog', 'ItemCatlogController@newcatlog');
    Route::post('item/catlog/newcatlog', 'ItemCatlogController@store');
    Route::get('item/catlog/delete', 'ItemCatlogController@delete');
    Route::post('item/catlog/delete', 'ItemCatlogController@execDelete');
    Route::get('item/catlog/merge', 'ItemCatlogController@merge');
    Route::post('item/catlog/merge', 'ItemCatlogController@execMerge');
    Route::post('item/catlog/seticon', 'ItemCatlogController@setIcon');
    Route::get('item/catlog/props', 'ItemCatlogController@props');
    Route::post('item/catlog/props', 'ItemCatlogController@batchDeleteProps');
    Route::any('item/catlog/newprops', 'ItemCatlogController@newProps');
    Route::any('item/catlog/extendprops', 'ItemCatlogController@extendProps');

    //订单管理
    Route::get('order', 'OrderController@index');
    Route::get('order/detail', 'OrderController@detail');
    Route::get('order/export', 'OrderController@export');
    Route::post('order/batchdelete', 'OrderController@batchDelete');
    //交易管理
    Route::get('transaction', 'TransactionController@index');
    Route::get('transaction/export', 'TransactionController@export');
    Route::post('transaction/batchdelete', 'TransactionController@batchDelete');
    //微信公众号管理
    Route::get('wechat/menu', 'WechatMenuController@index');
    Route::post('wechat/menu', 'WechatMenuController@batchUpdate');
    Route::get('wechat/menu/newmenu', 'WechatMenuController@newMenu');
    Route::post('wechat/menu/newmenu', 'WechatMenuController@storeMenu');
    Route::post('wechat/menu/apply', 'WechatMenuController@applyMenu');
    Route::post('wechat/menu/remove', 'WechatMenuController@removeMenu');

    Route::get('wechat/material', 'WechatMaterialController@material');
    Route::get('wechat/material/add', 'WechatMaterialController@addMaterial');
    Route::post('wechat/material/batchdelete', 'WechatMaterialController@batchDelete');
    Route::get('wechat/news', 'WechatMaterialController@news');
    Route::get('wechat/news/add', 'WechatMaterialController@addNews');
    Route::get('wechat/viewimage', 'WechatMaterialController@viewImage');

    //页面管理
    Route::get('pages', 'PagesController@index');
    Route::post('pages', 'PagesController@batchUpdate');
    Route::get('pages/newpage', 'PagesController@newpage');
    Route::post('pages/newpage', 'PagesController@savePage');
    Route::get('pages/category', 'PagesController@category');
    Route::post('pages/category', 'PagesController@saveCategory');
    //素材管理
    Route::get('material', 'MaterialController@index');
    Route::post('material', 'MaterialController@batchDelete');
    //区域管理
    Route::get('district', 'DistrictController@index');
    Route::post('district', 'DistrictController@store');
    //快递管理
    Route::get('express', 'ExpressController@index');
    Route::post('express', 'ExpressController@store');
    //友情链接
    Route::get('link', 'LinkController@index');
    Route::post('link', 'LinkController@store');
    Route::post('link/setimage', 'LinkController@setimage');
    //退货理由
    Route::get('refundreason', 'RefundReasonController@index');
    Route::post('refundreason', 'RefundReasonController@store');
});

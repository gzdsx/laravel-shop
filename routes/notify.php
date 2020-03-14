<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/8/28
 * Time: 下午3:16
 */

//WeChat
Route::any('wechat/server', 'Wechat\ServerController@index');
Route::any('wechat/notify', 'Wechat\NotifyController@index');
Route::any('wechat/notify/miniprogram', 'Wechat\NotifyController@miniProgram');

//Alipay
Route::any('alipay/notify', 'Alipay\NotifyController@index');

Route::group(['namespace' => 'Notify', 'prefix' => 'notify'], function () {
    Route::any('miniprogram', 'MiniprogramController@index');
    Route::any('wechatpay', 'WechatPayController@index');
    Route::any('alipay', 'AliPayController@index');
    Route::any('wechat/server', 'WechatServerController@index');
});

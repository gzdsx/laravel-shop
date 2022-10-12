<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/03/29
 * Time: 下午3:16
 */

Route::group(['namespace' => 'Notify'], function () {

    Route::group(['namespace' => 'Wechat', 'prefix' => 'wechat'], function () {
        Route::any('officalaccount/server','OfficialAccountController@server');
        Route::any('miniprogram/server','MiniProgramController@server');
        Route::any('recharge', 'RechargeController@paid');
        Route::any('order/paid/{app}','OrderController@paid');
        Route::any('order/refund/{app}','OrderController@refund');

        Route::any('peisong/paid', 'PeiSongController@paid');
        Route::any('dache/paid', 'DacheController@paid');

        Route::any('vip/paid', 'VipController@paid');
    });


    Route::group(['namespace'=>'Alipay','prefix'=>'alipay'],function (){
        Route::any('order.paid', 'OrderController@paid');
    });

    Route::group(['namespace'=>'Live','prefix'=>'live'],function (){
        Route::any('on_publish', 'LiveController@onPublish');
        Route::any('on_publish_done', 'LiveController@onPublishDone');
        Route::any('live/paid/{appid}', 'LiveController@paid');
    });
});

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
    Route::any('wechat/server', 'WechatController@server');
    Route::any('wechat/paid/{appid}', 'WechatPayController@paid');
    Route::any('wechat/refund/{appid}', 'WechatPayController@refund');

    Route::any('weapp/server', 'WeappController@server');

    Route::any('alipay/paid', 'AliPayController@paid');

    Route::any('live/on_publish', 'LiveController@onPublish');
    Route::any('live/on_publish_done', 'LiveController@onPublishDone');
    Route::any('live/paid/{appid}', 'LiveController@paid');
});

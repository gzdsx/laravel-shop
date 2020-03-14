<?php

/*
 * This file is part of the overtrue/laravel-wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
     * 默认配置，将会合并到各模块中
     */
    'defaults' => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
         */
        'response_type' => 'array',

        /*
         * 使用 Laravel 的缓存系统
         */
        'use_laravel_cache' => true,

        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => env('WECHAT_LOG_LEVEL', 'debug'),
            'file' => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
        ],
    ],

    /*
     * 路由配置
     */
    'route' => [
        /*
         * 开放平台第三方平台路由配置
         */
        // 'open_platform' => [
        //     'uri' => 'serve',
        //     'action' => Overtrue\LaravelWeChat\Controllers\OpenPlatformController::class,
        //     'attributes' => [
        //         'prefix' => 'open-platform',
        //         'middleware' => null,
        //     ],
        // ],
    ],

    /*
     * 公众号
     */
    'official_account' => [
        'default' => [
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'wx820de4d667f90671'),         // AppID
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', '7b2064688f84b78923b289e6f16d9091'),    // AppSecret
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', ''),           // Token
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey

            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
             */
            // 'oauth' => [
            //     'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
            //     'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
            // ],
        ],
    ],

    /*
     * 开放平台第三方平台
     */
    // 'open_platform' => [
    //     'default' => [
    //         'app_id'  => env('WECHAT_OPEN_PLATFORM_APPID', ''),
    //         'secret'  => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
    //         'token'   => env('WECHAT_OPEN_PLATFORM_TOKEN', ''),
    //         'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', ''),
    //     ],
    // ],

    /*
     * 小程序
     */
    'mini_program' => [
        'default' => [
            'app_id' => env('WECHAT_MINI_PROGRAM_APPID', 'wx52342f9e9c4b8b18'),
            'secret' => env('WECHAT_MINI_PROGRAM_SECRET', '6610198d88a7b0044e08addf3ba9933d'),
            'token' => env('WECHAT_MINI_PROGRAM_TOKEN', ''),
            'aes_key' => env('WECHAT_MINI_PROGRAM_AES_KEY', ''),
        ]
    ],

    'app' => [
        'default' => [
            'app_id' => 'wxd061fe9e48e8c5f1',
            'secret' => '1664d197a4d5d24fddf0c308903a8578',
            'token' => '',
            'aes_key' => ''
        ],
    ],
    /*
     * 微信支付
     */
    'payment' => [
        'default' => [
            'sandbox' => env('WECHAT_PAYMENT_SANDBOX', false),
            'app_id' => env('WECHAT_PAYMENT_APPID', 'wx68fe44528075f3cb'),
            'mch_id' => env('WECHAT_PAYMENT_MCH_ID', '1386271002'),
            'key' => env('WECHAT_PAYMENT_KEY', 'acb94afb13018ebc114a65610407f67b'),
            'cert_path' => env('WECHAT_PAYMENT_CERT_PATH', base_path('cert/wechat/apiclient_cert.pem')),    // XXX: 绝对路径！！！！
            'key_path' => env('WECHAT_PAYMENT_KEY_PATH', base_path('cert/wechat/apiclient_key.pem')),      // XXX: 绝对路径！！！！
            'notify_url' => 'https://cg.gzdsx.cn/notify/wechatpay', // 默认支付结果通知地址
            'trade_type' => 'JSAPI'
        ]
    ],

    /*
     * 企业微信
     */
    // 'work' => [
    //     'default' => [
    //         'corp_id' => 'xxxxxxxxxxxxxxxxx',
    ///        'agent_id' => 100020,
    //         'secret'   => env('WECHAT_WORK_AGENT_CONTACTS_SECRET', ''),
    //          //...
    //      ],
    // ],
];

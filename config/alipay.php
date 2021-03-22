<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-05
 * Time: 16:10
 */

return [
    'default' => [
        'app_id' => env('ALIPAY_APP_ID', ''),
        'public_key' => env('ALIPAY_PUBLIC_KEY', ''),
        'private_key' => env('ALIPAY_PRIVATE_KEY', ''),
        'return_url' => env('ALIPAY_RETRUN_URL', ''),
        'notify_url' => env('ALIPAY_NOTIFY_URL', '/notify/alipay/paid'),
    ]
];

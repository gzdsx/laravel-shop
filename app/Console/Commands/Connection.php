<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2022 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2022/10/6
 * Time: 上午5:14
 */

namespace App\Console\Commands;


use Illuminate\Support\Facades\DB;

trait Connection
{
    protected function connection()
    {
        return DB::connection('shop');
    }
}

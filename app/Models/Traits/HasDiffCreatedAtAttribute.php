<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2022 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2022/6/12
 * Time: 下午3:11
 */

namespace App\Models\Traits;


use Illuminate\Support\Carbon;

trait HasDiffCreatedAtAttribute
{
    /**
     * @return Carbon|null
     */
    public function getDiffCreatedAtAttribute()
    {

        if (now() > $this->created_at->addDays(15)) {
            return $this->serializeDate($this->created_at);
        }

        return $this->created_at->diffForHumans();
    }
}

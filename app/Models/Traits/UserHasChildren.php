<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2022 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2022/9/22
 * Time: 下午6:19
 */

namespace App\Models\Traits;


use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserHasChildren
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->subUsers()->with('children');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subUsers()
    {
        return $this->hasMany(User::class, 'parent_id', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'uid');
    }
}

<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/11/15
 * Time: 3:46 PM
 */

namespace App\Models\Traits;


use App\Models\PostCollect;
use App\Models\PostItem;

trait UserCmsRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(PostItem::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postCollects(){
        return $this->hasMany(PostCollect::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collectedPosts()
    {
        return $this->hasManyThrough(
            PostItem::class,
            PostCollect::class,
            'uid',
            'aid',
            'uid',
            'aid'
        );
    }
}

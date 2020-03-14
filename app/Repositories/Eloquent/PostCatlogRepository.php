<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-22
 * Time: 18:52
 */

namespace App\Repositories\Eloquent;


use App\Models\PostCatlog;
use App\Repositories\Contracts\PostCatlogRepositoryInterface;

class PostCatlogRepository extends CatlogRepository implements PostCatlogRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return PostCatlog::class;
    }

    public function cacheName()
    {
        // TODO: Implement cacheName() method.
        return 'postCatlogs';
    }
}

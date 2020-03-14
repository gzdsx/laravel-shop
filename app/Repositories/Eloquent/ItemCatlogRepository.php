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
 * Time: 21:24
 */

namespace App\Repositories\Eloquent;


use App\Models\ItemCatlog;
use App\Repositories\Contracts\ItemCatlogRepositoryInterface;

class ItemCatlogRepository extends CatlogRepository implements ItemCatlogRepositoryInterface
{
    public function model()
    {
        // TODO: Implement getModel() method.
        return ItemCatlog::class;
    }

    /**
     * @return string
     */
    public function cacheName()
    {
        // TODO: Implement cacheName() method.
        return 'itemCatlogs';
    }
}

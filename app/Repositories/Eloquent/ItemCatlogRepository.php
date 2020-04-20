<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/20
 * Time: 5:23 上午
 */

namespace App\Repositories\Eloquent;


use App\Models\ItemCatlog;
use App\Repositories\Contracts\ItemCatlogRepositoryInterface;

class ItemCatlogRepository extends CatlogRepository implements ItemCatlogRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement model() method.
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

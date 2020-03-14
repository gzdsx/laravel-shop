<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-25
 * Time: 11:36
 */

namespace App\Repositories\Eloquent;


use App\Models\Link;
use App\Repositories\Contracts\LinkRepositoryInterface;

class LinkRepository extends BaseRepository implements LinkRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return Link::class;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getCategories()
    {
        // TODO: Implement getCategories() method.
        return $this->where('type', 'category')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getItems()
    {
        // TODO: Implement getItems() method.
        return $this->where('type', 'item')->get();
    }
}

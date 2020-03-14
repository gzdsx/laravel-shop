<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-26
 * Time: 11:47
 */

namespace App\Repositories\Eloquent;


use App\Models\BlockItem;
use App\Repositories\Contracts\BlockItemRepositoryInterface;

class BlockItemRepository extends BaseRepository implements BlockItemRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return BlockItem::class;
    }
}

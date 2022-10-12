<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 14:01
 */

namespace App\Repositories\Eloquent;


use App\Models\CommonMaterial;
use App\Repositories\Contracts\MaterialRepositoryInterface;

class MaterialRepository extends BaseRepository implements MaterialRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return CommonMaterial::class;
    }

    public function query()
    {
        // TODO: Implement query() method.
        return CommonMaterial::query();
    }
}

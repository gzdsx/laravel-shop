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
 * Time: 12:15
 */

namespace App\Repositories\Eloquent;


use App\Models\Express;
use App\Repositories\Contracts\ExpressRepositoryInterface;

class ExpressRepository extends BaseRepository implements ExpressRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return Express::class;
    }
}

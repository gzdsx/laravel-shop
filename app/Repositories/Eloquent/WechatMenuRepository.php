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
 * Time: 13:22
 */

namespace App\Repositories\Eloquent;


use App\Models\WechatMenu;
use App\Repositories\Contracts\WechatMenuRepositoryInterface;

class WechatMenuRepository extends BaseRepository implements WechatMenuRepositoryInterface
{
    protected $filterable = false;

    public function model()
    {
        // TODO: Implement model() method.
        return WechatMenu::class;
    }
}

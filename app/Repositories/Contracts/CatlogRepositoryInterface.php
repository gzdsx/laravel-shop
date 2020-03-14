<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-19
 * Time: 23:12
 */

namespace App\Repositories\Contracts;


interface CatlogRepositoryInterface extends RepositoryInterface
{
    public function fetchAll($fid = 0, $withGlobalScopes = true);

    public function fetchAllIds($fid = 0, $withGlobalScopes = true);

    public function fetchOptions($fid = 0, $default = 0, $withGlobalScopes = true);

    public function fetchAllFromCache();

    public function updateCache();
}

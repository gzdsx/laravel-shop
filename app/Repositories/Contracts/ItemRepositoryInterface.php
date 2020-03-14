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
 * Time: 21:26
 */

namespace App\Repositories\Contracts;


interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param \App\Models\Item $item
     * @param $content
     * @return \App\Models\Item
     */
    public function updateContent($item, $content);

    /**
     * @param \App\Models\Item $item
     * @param array $images
     * @return \App\Models\Item
     */
    public function updateImages($item, array $images);
}

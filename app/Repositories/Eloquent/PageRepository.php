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
 * Time: 11:53
 */

namespace App\Repositories\Eloquent;


use App\Models\Page;
use App\Repositories\Contracts\PageRepositoryInterface;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return Page::class;
    }

    /**
     * @return $this|PageRepositoryInterface
     */
    public function pages()
    {
        // TODO: Implement pages() method.
        $this->model = $this->model->where('type', 'page');
        return $this;
    }

    /**
     * @return $this|PageRepositoryInterface
     */
    public function categories()
    {
        // TODO: Implement categories() method.
        $this->model = $this->model->where('type', 'category');
        return $this;
    }
}

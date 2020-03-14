<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-21
 * Time: 15:19
 */

namespace App\Services\Contracts;


interface ServiceInterface
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes);

    /**
     * @param $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $attributes);

    /**
     * @param $uid
     * @return mixed
     */
    public function delete($id);

    /**
     * @param array $filter
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate(array $filter = [], $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * @param array $filer
     * @param int $count
     * @param int $offset
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(array $filter = [], $count = 10, $offset = 0);

    /**
     * @param array $items
     * @param array $values
     * @return mixed
     */
    public function batchUpdate(array $items, array $values);

    /**
     * @param array $items
     * @return mixed
     */
    public function batchDelete(array $items);
}

<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-18
 * Time: 13:38
 */

namespace App\Repositories\Contracts;


use App\Models\Order;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*']);

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|Order
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first($columns = ['*']);

    /**
     * @param array $attributes
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $attributes, array $values = []);

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrFail($columns = ['*']);

    /**
     * @param array $attributes
     * @param array $values
     * @return Builder|Model
     */
    public function firstOrCreate(array $attributes, array $values = []);

    /**
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function all($columns = ['*']);

    /**
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = ['*']);

    /**
     * @return mixed
     */
    public function toSql();

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $attributes = []);

    /**
     * @param array $filter
     * @param int $offset
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function fetch($offset = 0, $count = 20, $columns = ['*']);

    /**
     * @param array $filter
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * @param array $filter
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Pagination\Paginator
     */
    public function simplePaginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function update(array $attributes);

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * @param Model $model
     * @param bool $force
     * @return mixed
     */
    public function delete($force = false);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $filter
     * @return $this
     */
    public function filter($filter);

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations);

    /**
     * @param $relations
     * @return $this
     */
    public function withCount($relations);

    /**
     * @param $relations
     * @return $this
     */
    public function without($relations);

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and');

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereIn($column, $values, $boolean = 'and', $not = false);

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     * @return $this
     */
    public function whereNotIn($column, $values, $boolean = 'and');

    /**
     * @param $relation
     * @param string $operator
     * @param int $count
     * @param string $boolean
     * @param null $callback
     * @return $this
     */
    public function has($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null);

    /**
     * @param $relation
     * @param null $callback
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereHas($relation, $callback = null, $operator = '>=', $count = 1);

    /**
     * @param $relation
     * @param string $boolean
     * @param Closure|null $callback
     * @return $this
     */
    public function doesntHave($relation, $boolean = 'and', Closure $callback = null);

    /**
     * @param $id
     * @return $this
     */
    public function whereKey($id);

    /**
     * @param $id
     * @return $this
     */
    public function whereKeyNot($id);

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function orWhere($column, $operator = null, $value = null);

    /**
     * @param array|null $scopes
     * @return $this
     */
    public function withoutGlobalScopes(array $scopes = null);

    /**
     * @param $identifier
     * @param $scope
     * @return $this
     */
    public function withGlobalScope($identifier, $scope);

    /**
     * @param array $scopes
     * @return $this
     */
    public function scopes(array $scopes);

    /**
     * @param $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * @param $column
     * @return $this
     */
    public function orderByDesc($column);

    /**
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset);

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit);

    /**
     * @param array $columns
     * @return $this
     */
    public function select(array $columns = ['*']);

    /**
     * @param $columns
     * @return int
     */
    public function count($columns = ['*']);
}

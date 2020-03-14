<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 23:13
 */

namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\RepositoryInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories\Eloquent
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var bool
     */
    protected $filterable = true;

    /**
     * BaseRepository constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->model = $this->makeModel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    abstract public function model();

    /**
     * @throws \Exception
     */
    public function resetModel()
    {
        $this->model = $this->makeModel();
    }

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function find($id, $columns = ['*'])
    {
        // TODO: Implement find() method.
        $result = $this->model->find($id, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findOrNew($id, $columns = ['*'])
    {
        $result = $this->model->findOrNew($id, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     * @throws \Exception
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $result = $this->model->findOrFail($id, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function first($columns = ['*'])
    {
        $result = $this->model->first($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Builder|Model
     * @throws \Exception
     */
    public function firstOrNew(array $attributes, array $values = [])
    {
        $result = $this->model->firstOrNew($attributes, $values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return Builder|Model|mixed
     * @throws \Exception
     */
    public function firstOrFail($columns = ['*'])
    {
        $result = $this->model->firstOrFail($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Builder|Model
     * @throws \Exception
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        $result = $this->model->firstOrCreate($attributes, $values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function all($columns = ['*'])
    {
        // TODO: Implement all() method.
        if ($this->model instanceof Builder) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }
        $this->resetModel();
        return $results;
    }

    /**
     * @param array $colums
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function get($columns = ['*'])
    {
        // TODO: Implement get() method.
        return $this->all($columns);
    }

    /**
     * @return mixed
     */
    public function toSql()
    {
        // TODO: Implement toSql() method.
        return $this->model->toSql();
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws \Exception
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        // TODO: Implement findBy() method.
        $result = $this->model->where($attribute, '=', $value)->first($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param int $offset
     * @param int $count
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     * @throws \Exception
     */
    public function fetch($offset = 0, $count = 20, $columns = ['*'])
    {
        // TODO: Implement fetch() method.
        $result = $this->model->offset($offset)->limit($count)->get($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\Paginator
     * @throws \Exception
     */
    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
        $result = $this->model->paginate($perPage, $columns, $pageName, $page);
        $this->resetModel();
        return $result;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Pagination\Paginator
     * @throws \Exception
     */
    public function simplePaginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement simplePaginate() method.
        $result = $this->model->simplePaginate($perPage, $columns, $pageName, $page);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function make(array $attributes = [])
    {
        // TODO: Implement make() method.
        $result = $this->model->make($attributes);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $result = $this->model->create($attributes);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @return bool|mixed
     * @throws \Exception
     */
    public function update(array $attributes)
    {
        // TODO: Implement update() method.
        $result = 0;
        foreach ($this->model->get() as $model) {
            $model->fill($attributes);
            $result += $model->save();
        }
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Builder|Model
     * @throws \Exception
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $result = $this->model->updateOrCreate($attributes, $values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param bool $force
     * @return int|mixed
     * @throws \Exception
     */
    public function delete($force = false)
    {
        // TODO: Implement delete() method.
        $result = 0;
        foreach ($this->model->get() as $model) {
            $result += $force ? $model->forceDelete() : $model->delete();
        }
        $this->resetModel();
        return $result;
    }

    /**
     * @param $id
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        $result = false;
        if ($model = $this->model->find($id)) {
            $result = $model->delete();
        }
        $this->resetModel();
        return $result;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function filter($filter)
    {
        // TODO: Implement filter() method.
        if ($this->filterable) {
            $this->model = $this->model->filter($filter);
        } else {
            $this->model = $this->model->where($filter);
        }
        return $this;
    }

    /**
     * @param $relation
     * @param string $operator
     * @param int $count
     * @param string $boolean
     * @param null $callback
     * @return $this|bool
     */
    public function has($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
    {
        // TODO: Implement has() method.
        $this->model = $this->model->has($relation, $operator, $count, $boolean, $callback);
        return $this;
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        // TODO: Implement where() method.
        $this->model = $this->model->where($column, $operator, $value, $boolean);
        return $this;
    }

    /**
     * @param $relation
     * @param null $callback
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereHas($relation, $callback = null, $operator = '>=', $count = 1)
    {
        // TODO: Implement whereHas() method.
        $this->model = $this->model->whereHas($relation, $callback, $operator, $count);
        return $this;
    }

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        // TODO: Implement whereIn() method.
        $this->model = $this->model->whereIn($column, $values, $boolean, $not);
        return $this;
    }

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     * @return $this
     */
    public function whereNotIn($column, $values, $boolean = 'and')
    {
        // TODO: Implement whereNotIn() method.
        $this->model = $this->model->whereNotIn($column, $values, $boolean);
        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations)
    {
        // TODO: Implement with() method.
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function withCount($relations)
    {
        $this->model = $this->model->withCount($relations);
        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function without($relations)
    {
        $this->model = $this->model->without($relations);
        return $this;
    }

    /**
     * @param $relation
     * @param string $boolean
     * @param Closure|null $callback
     * @return $this
     */
    public function doesntHave($relation, $boolean = 'and', Closure $callback = null)
    {
        $this->model = $this->model->doesntHave($relation, $boolean, $callback);
        return $this;
    }

    /**
     * @param $id
     * @return $this|RepositoryInterface
     */
    public function whereKey($id)
    {
        // TODO: Implement whereKey() method.
        $this->model = $this->model->whereKey($id);
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function whereKeyNot($id)
    {
        $this->model = $this->model->whereKeyNot($id);
        return $this;
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function orWhere($column, $operator = null, $value = null)
    {
        $this->model = $this->model->orWhere($column, $operator, $value);
        return $this;
    }

    /**
     * @param array|null $scopes
     * @return $this
     */
    public function withoutGlobalScopes(array $scopes = null)
    {
        // TODO: Implement withoutGlobalScopes() method.
        $this->model = $this->model->withoutGlobalScopes($scopes);
        return $this;
    }

    /**
     * @param $identifier
     * @param $scope
     * @return $this
     */
    public function withGlobalScope($identifier, $scope)
    {
        $this->model = $this->model->withGlobalScope($identifier, $scope);
        return $this;
    }

    /**
     * @param array $scopes
     * @return $this|RepositoryInterface
     */
    public function scopes(array $scopes)
    {
        $this->model = $this->model->scopes($scopes);
        return $this;
    }

    /**
     * @param $column
     * @param string $direction
     * @return RepositoryInterface
     */
    public function orderBy($column, $direction = 'asc')
    {
        // TODO: Implement orderBy() method.
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    /**
     * @param $column
     * @return RepositoryInterface
     */
    public function orderByDesc($column)
    {
        // TODO: Implement orderByDesc() method.
        $this->model = $this->model->orderByDesc($column);
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset)
    {
        $this->model = $this->model->offset($offset);
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->model = $this->model->limit($limit);
        return $this;
    }

    /**
     * @param array $columns
     * @return $this|RepositoryInterface
     */
    public function select(array $columns = ['*'])
    {
        // TODO: Implement select() method.
        $this->model = $this->model->select($columns);
        return $this;
    }

    /**
     * @param array $columns
     * @return int
     * @throws \Exception
     */
    public function count($columns = ['*'])
    {
        // TODO: Implement count() method.
        $result = $this->model->count($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model", 400);
        }
        return $model;
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->model->{$method}(...$parameters);
    }
}

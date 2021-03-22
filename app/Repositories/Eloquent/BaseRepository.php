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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories\Eloquent
 * @method \Illuminate\Database\Eloquent\Builder withGlobalScope($identifier, $scope)
 * @method \Illuminate\Database\Eloquent\Builder withoutGlobalScope($scope)
 * @method \Illuminate\Database\Eloquent\Builder withoutGlobalScopes($scopes = null)
 * @method \Illuminate\Database\Eloquent\Builder whereKey($id)
 * @method \Illuminate\Database\Eloquent\Builder whereKeyNot($id)
 * @method \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhere($column, $operator = null, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder without($relations)
 * @method \Illuminate\Database\Eloquent\Builder newModelInstance($attributes = array())
 * @method \Illuminate\Database\Eloquent\Builder getQuery()
 * @method \Illuminate\Database\Eloquent\Builder setQuery($query)
 * @method \Illuminate\Database\Eloquent\Builder toBase()
 * @method \Illuminate\Database\Eloquent\Builder has($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orHas($relation, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder doesntHave($relation, $boolean = 'and', $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orDoesntHave($relation)
 * @method \Illuminate\Database\Eloquent\Builder whereHas($relation, $callback = null, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder orWhereHas($relation, $callback = null, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder whereDoesntHave($relation, $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orWhereDoesntHave($relation, $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder withCount($relations)
 * @method \Illuminate\Database\Eloquent\Builder mergeConstraintsFrom($from)
 * @method \Illuminate\Database\Eloquent\Builder select($columns = array())
 * @method \Illuminate\Database\Eloquent\Builder selectSub($query, $as)
 * @method \Illuminate\Database\Eloquent\Builder selectRaw($expression, $bindings = array())
 * @method \Illuminate\Database\Eloquent\Builder fromSub($query, $as)
 * @method \Illuminate\Database\Eloquent\Builder fromRaw($expression, $bindings = array())
 * @method \Illuminate\Database\Eloquent\Builder addSelect($column)
 * @method \Illuminate\Database\Eloquent\Builder distinct()
 * @method \Illuminate\Database\Eloquent\Builder from($table)
 * @method \Illuminate\Database\Eloquent\Builder join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method \Illuminate\Database\Eloquent\Builder joinWhere($table, $first, $operator, $second, $type = 'inner')
 * @method \Illuminate\Database\Eloquent\Builder joinSub($query, $as, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method \Illuminate\Database\Eloquent\Builder leftJoin($table, $first, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder leftJoinWhere($table, $first, $operator, $second)
 * @method \Illuminate\Database\Eloquent\Builder leftJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder rightJoin($table, $first, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder rightJoinWhere($table, $first, $operator, $second)
 * @method \Illuminate\Database\Eloquent\Builder rightJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder crossJoin($table, $first = null, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder mergeWheres($wheres, $bindings)
 * @method \Illuminate\Database\Eloquent\Builder whereColumn($first, $operator = null, $second = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereColumn($first, $operator = null, $second = null)
 * @method \Illuminate\Database\Eloquent\Builder whereRaw($sql, $bindings = array(), $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereRaw($sql, $bindings = array())
 * @method \Illuminate\Database\Eloquent\Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder orWhereIn($column, $values)
 * @method \Illuminate\Database\Eloquent\Builder whereNotIn($column, $values, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereNotIn($column, $values)
 * @method \Illuminate\Database\Eloquent\Builder whereIntegerInRaw($column, $values, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder whereIntegerNotInRaw($column, $values, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder whereNull($column, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder orWhereNull($column)
 * @method \Illuminate\Database\Eloquent\Builder whereNotNull($column, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder whereBetween($column, $values, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder orWhereBetween($column, $values)
 * @method \Illuminate\Database\Eloquent\Builder whereNotBetween($column, $values, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereNotBetween($column, $values)
 * @method \Illuminate\Database\Eloquent\Builder orWhereNotNull($column)
 * @method \Illuminate\Database\Eloquent\Builder whereDate($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereDate($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder whereTime($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereTime($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder whereDay($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereDay($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder whereMonth($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereMonth($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder whereYear($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereYear($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder whereNested($callback, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder forNestedWhere()
 * @method \Illuminate\Database\Eloquent\Builder addNestedWhereQuery($query, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder whereExists($callback, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder orWhereExists($callback, $not = false)
 * @method \Illuminate\Database\Eloquent\Builder whereNotExists($callback, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereNotExists($callback)
 * @method \Illuminate\Database\Eloquent\Builder addWhereExistsQuery($query, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder whereRowValues($columns, $operator, $values, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereRowValues($columns, $operator, $values)
 * @method \Illuminate\Database\Eloquent\Builder whereJsonContains($column, $value, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder orWhereJsonContains($column, $value)
 * @method \Illuminate\Database\Eloquent\Builder whereJsonDoesntContain($column, $value, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereJsonDoesntContain($column, $value)
 * @method \Illuminate\Database\Eloquent\Builder whereJsonLength($column, $operator, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orWhereJsonLength($column, $operator, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder dynamicWhere($method, $parameters)
 * @method \Illuminate\Database\Eloquent\Builder groupBy($groups = null)
 * @method \Illuminate\Database\Eloquent\Builder having($column, $operator = null, $value = null, $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orHaving($column, $operator = null, $value = null)
 * @method \Illuminate\Database\Eloquent\Builder havingBetween($column, $values, $boolean = 'and', $not = false)
 * @method \Illuminate\Database\Eloquent\Builder havingRaw($sql, $bindings = array(), $boolean = 'and')
 * @method \Illuminate\Database\Eloquent\Builder orHavingRaw($sql, $bindings = array())
 * @method \Illuminate\Database\Eloquent\Builder orderBy($column, $direction = 'asc')
 * @method \Illuminate\Database\Eloquent\Builder orderByDesc($column)
 * @method \Illuminate\Database\Eloquent\Builder inRandomOrder($seed = '')
 * @method \Illuminate\Database\Eloquent\Builder orderByRaw($sql, $bindings = array())
 * @method \Illuminate\Database\Eloquent\Builder skip($value)
 * @method \Illuminate\Database\Eloquent\Builder offset($value)
 * @method \Illuminate\Database\Eloquent\Builder take($value)
 * @method \Illuminate\Database\Eloquent\Builder limit($value)
 * @method \Illuminate\Database\Eloquent\Builder forPage($page, $perPage = 15)
 * @method \Illuminate\Database\Eloquent\Builder forPageBeforeId($perPage = 15, $lastId = 0, $column = 'id')
 * @method \Illuminate\Database\Eloquent\Builder forPageAfterId($perPage = 15, $lastId = 0, $column = 'id')
 * @method \Illuminate\Database\Eloquent\Builder union($query, $all = false)
 * @method \Illuminate\Database\Eloquent\Builder unionAll($query)
 * @method \Illuminate\Database\Eloquent\Builder lock($value = true)
 * @method \Illuminate\Database\Eloquent\Builder lockForUpdate()
 * @method \Illuminate\Database\Eloquent\Builder sharedLock()
 * @method \Illuminate\Database\Eloquent\Builder hasMorph($relation, $types, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orHasMorph($relation, $types, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder doesntHaveMorph($relation, $types, $boolean = 'and', $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orDoesntHaveMorph($relation, $types)
 * @method \Illuminate\Database\Eloquent\Builder whereHasMorph($relation, $types, $callback = null, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder orWhereHasMorph($relation, $types, $callback = null, $operator = '>=', $count = 1)
 * @method \Illuminate\Database\Eloquent\Builder whereDoesntHaveMorph($relation, $types, $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder orWhereDoesntHaveMorph($relation, $types, $callback = null)
 * @method \Illuminate\Database\Eloquent\Builder addBinding($value, $type = 'where')
 * @method \Illuminate\Database\Eloquent\Builder mergeBindings($query)
 * @method \Illuminate\Database\Eloquent\Builder scopes($scopes)
 * @method \Illuminate\Database\Eloquent\Builder applyScopes()
 * @method \Illuminate\Database\Eloquent\Builder setBindings($bindings, $type = 'where')
 * @method void dd()
 * @method void dump()
 * @method string toSql()
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder|Model
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
     * @param $model
     * @return Builder|void
     */
    public function setModel($model)
    {
        // TODO: Implement setModel() method.
        $this->model = $model;
    }

    /**
     * @return Builder|Model
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return $this->model();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    abstract public function model();


    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
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
     * @throws \Exception
     */
    public function resetModel()
    {
        $this->model = $this->makeModel();
    }

    /**
     * @param array $attributes
     * @return RepositoryInterface|Builder|Model|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function make($attributes = [])
    {
        // TODO: Implement make() method.
        $result = $this->model->make($attributes);
        $this->resetModel();
        return $result;
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
        $results = $this->all($columns);
        $this->resetModel();
        return $results;
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
        $result = $this->model->update($attributes);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Model|mixed
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
     * @return int|mixed
     * @throws \Exception
     */
    public function forceDelete()
    {
        // TODO: Implement forceDelete() method.
        $result = 0;
        foreach ($this->model->get() as $model) {
            $result += $model->forceDelete();
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
        foreach ($this->model->whereKey($id)->get() as $model) {
            $result += $model->delete();
        }
        $this->resetModel();
        return $result;
    }

    /**
     * @param $input
     * @param null $filter
     * @return $this|Builder
     */
    public function filter($input, $filter = null)
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
     * @param string $function
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function aggregate($function, $columns = [])
    {
        // TODO: Implement aggregate() method.
        $result = $this->model->aggregate($function, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function average($column)
    {
        // TODO: Implement average() method.
        $result = $this->model->average($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function avg($column)
    {
        // TODO: Implement avg() method.
        $result = $this->model->avg($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $count
     * @param $callback
     * @return bool
     * @throws \Exception
     */
    public function chunk($count, $callback)
    {
        // TODO: Implement chunk() method.
        $result = $this->model->chunk($count, $callback);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $count
     * @param $callback
     * @param null $column
     * @param null $alias
     * @return bool
     * @throws \Exception
     */
    public function chunkById($count, $callback, $column = null, $alias = null)
    {
        // TODO: Implement chunkById() method.
        $result = $this->model->chunkById($count, $callback, $column, $alias);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $properties
     * @return RepositoryInterface|Builder
     * @throws \Exception
     */
    public function cloneWithout($properties)
    {
        // TODO: Implement cloneWithout() method.
        $result = $this->model->cloneWithout($properties);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $except
     * @return RepositoryInterface|Builder
     * @throws \Exception
     */
    public function cloneWithoutBindings($except)
    {
        // TODO: Implement cloneWithoutBindings() method.
        $result = $this->model->cloneWithoutBindings($except);
        $this->resetModel();
        return $result;
    }

    /**
     * @return \Illuminate\Support\LazyCollection
     * @throws \Exception
     */
    public function cursor()
    {
        // TODO: Implement cursor() method.
        $result = $this->model->cursor();
        $this->resetModel();
        return $result;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function doesntExist()
    {
        // TODO: Implement doesntExist() method.
        $result = $this->model->doesntExist();
        $this->resetModel();
        return $result;
    }

    /**
     * @param \Closure $callback
     * @return mixed
     * @throws \Exception
     */
    public function doesntExistOr($callback)
    {
        // TODO: Implement doesntExistOr() method.
        $result = $this->model->doesntExistOr($callback);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $models
     * @return array
     * @throws \Exception
     */
    public function eagerLoadRelations($models)
    {
        // TODO: Implement eagerLoadRelations() method.
        $result = $this->model->eagerLoadRelations($models);
        $this->resetModel();
        return $result;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function exists()
    {
        // TODO: Implement exists() method.
        $result = $this->model->exists();
        $this->resetModel();
        return $result;
    }

    /**
     * @param \Closure $callback
     * @return mixed
     * @throws \Exception
     */
    public function existsOr($callback)
    {
        // TODO: Implement existsOr() method.
        $result = $this->model->existsOr($callback);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @param null $callback
     * @return RepositoryInterface|Builder|Model|mixed
     * @throws \Exception
     */
    public function firstOr($columns = array(), $callback = null)
    {
        // TODO: Implement firstOr() method.
        $result = $this->model->firstOr($columns, $callback);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @return RepositoryInterface|Builder|Model
     * @throws \Exception
     */
    public function forceCreate($attributes)
    {
        // TODO: Implement forceCreate() method.
        $result = $this->model->forceCreate($attributes);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $query
     * @param array $bindings
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function fromQuery($query, $bindings = [])
    {
        // TODO: Implement fromQuery() method.
        $result = $this->model->fromQuery($query, $bindings);
        $this->resetModel();
        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getBindings()
    {
        // TODO: Implement getBindings() method.
        $result = $this->model->getBindings();
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return int
     * @throws \Exception
     */
    public function getCountForPagination($columns = [])
    {
        // TODO: Implement getCountForPagination() method.
        $result = $this->model->getCountForPagination($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getEagerLoads()
    {
        // TODO: Implement getEagerLoads() method.
        $result = $this->model->getEagerLoads();
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $name
     * @return \Closure
     * @throws \Exception
     */
    public function getGlobalMacro($name)
    {
        // TODO: Implement getGlobalMacro() method.
        $result = $this->model->getGlobalMacro($name);
        $this->resetModel();
        return $result;
    }

    /**
     * @return \Illuminate\Database\Query\Grammars\Grammar
     * @throws \Exception
     */
    public function getGrammar()
    {
        // TODO: Implement getGrammar() method.
        $result = $this->model->getGrammar();
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $name
     * @return \Closure
     * @throws \Exception
     */
    public function getMacro($name)
    {
        // TODO: Implement getMacro() method.
        $result = $this->model->getMacro($name);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return RepositoryInterface[]|Builder[]|Model[]
     * @throws \Exception
     */
    public function getModels($columns = [])
    {
        // TODO: Implement getModels() method.
        $result = $this->model->getModels($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @return \Illuminate\Database\Query\Processors\Processor
     * @throws \Exception
     */
    public function getProcessor()
    {
        // TODO: Implement getProcessor() method.
        $result = $this->model->getProcessor();
        $this->resetModel();
        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getRawBindings()
    {
        // TODO: Implement getRawBindings() method.
        $result = $this->model->getRawBindings();
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function hasGlobalMacro($name)
    {
        // TODO: Implement hasGlobalMacro() method.
        $result = $this->model->hasGlobalMacro($name);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function hasMacro($name)
    {
        // TODO: Implement hasMacro() method.
        $result = $this->model->hasMacro($name);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $items
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function hydrate($items)
    {
        // TODO: Implement hydrate() method.
        $result = $this->model->hydrate($items);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $values
     * @return bool
     * @throws \Exception
     */
    public function insert($values)
    {
        // TODO: Implement insert() method.
        $result = $this->model->insert($values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $values
     * @param null $sequence
     * @return int
     * @throws \Exception
     */
    public function insertGetId($values, $sequence = null)
    {
        // TODO: Implement insertGetId() method.
        $result = $this->model->insertGetId($values, $sequence);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $values
     * @return int
     * @throws \Exception
     */
    public function insertOrIgnore($values)
    {
        // TODO: Implement insertOrIgnore() method.
        $result = $this->model->insertOrIgnore($values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @param \Closure|\Illuminate\Database\Query\Builder|string $query
     * @return int
     * @throws \Exception
     */
    public function insertUsing($columns, $query)
    {
        // TODO: Implement insertUsing() method.
        $result = $this->model->insertUsing($columns, $query);
        $this->resetModel();
        return $result;
    }

    /**
     * @param null $column
     * @return Builder
     * @throws \Exception
     */
    public function latest($column = null)
    {
        // TODO: Implement latest() method.
        $result = $this->model->latest($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function max($column)
    {
        // TODO: Implement max() method.
        $result = $this->model->max($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function min($column)
    {
        // TODO: Implement min() method.
        $result = $this->model->min($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $function
     * @param array $columns
     * @return float|int
     * @throws \Exception
     */
    public function numericAggregate($function, $columns = [])
    {
        // TODO: Implement numericAggregate() method.
        $result = $this->model->numericAggregate($function, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param null $column
     * @return Builder
     * @throws \Exception
     */
    public function oldest($column = null)
    {
        // TODO: Implement oldest() method.
        $result = $this->model->oldest($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param \Closure $callback
     * @throws \Exception
     */
    public function onDelete($callback)
    {
        // TODO: Implement onDelete() method.
        $result = $this->model->onDelete($callback);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @param null $key
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function pluck($column, $key = null)
    {
        // TODO: Implement pluck() method.
        $result = $this->model->pluck($column, $key);
        $this->resetModel();
        return $result;
    }

    /**
     * @param mixed $value
     * @return \Illuminate\Database\Query\Expression
     * @throws \Exception
     */
    public function raw($value)
    {
        // TODO: Implement raw() method.
        $result = $this->model->raw($value);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function sum($column)
    {
        // TODO: Implement sum() method.
        $result = $this->model->sum($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @throws \Exception
     */
    public function truncate()
    {
        // TODO: Implement truncate() method.
        $result = $this->model->truncate();
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return bool
     * @throws \Exception
     */
    public function updateOrInsert($attributes, $values = [])
    {
        // TODO: Implement updateOrInsert() method.
        $result = $this->model->updateOrInsert($attributes, $values);
        $this->resetModel();
        return $result;
    }

    /**
     * @param string $column
     * @return mixed
     * @throws \Exception
     */
    public function value($column)
    {
        // TODO: Implement value() method.
        $result = $this->model->value($column);
        $this->resetModel();
        return $result;
    }

    /**
     * @param mixed $value
     * @param callable $callback
     * @param null $default
     * @return RepositoryInterface|\Illuminate\Contracts\Container\ContextualBindingBuilder|Builder|mixed
     * @throws \Exception
     */
    public function when($value, $callback, $default = null)
    {
        // TODO: Implement when() method.
        $result = $this->model->when($value, $callback, $default);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array|\Illuminate\Contracts\Support\Arrayable $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function findMany($ids, $columns = [])
    {
        // TODO: Implement findMany() method.
        $result = $this->model->findMany($ids,$columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $method
     * @param $parameters
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function __call($method, $parameters)
    {
        return $this->model->{$method}(...$parameters);
    }
}

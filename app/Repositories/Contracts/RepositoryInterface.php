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

/**
 * Interface RepositoryInterface
 * @package App\Repositories\Contracts
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
 * @method \Illuminate\Database\Eloquent\Builder setModel($model)
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
 *
 */

interface RepositoryInterface
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model();

    /**
     * Create and return an un-saved model instance.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function make($attributes = []);

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*']);

    /**
     * Find multiple models by their primary keys.
     *
     * @param \Illuminate\Contracts\Support\Arrayable|array $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids, $columns = []);

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*']);

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first($columns = ['*']);

    /**
     * Execute the query and get the first result or call a callback.
     *
     * @param \Closure|array $columns
     * @param \Closure|null $callback
     * @return \Illuminate\Database\Eloquent\Model|static|mixed
     */
    public function firstOr($columns = array(), $callback = null);

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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $attributes, array $values = []);

    /**
     * @param null $column
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function latest($column = null);

    /**
     * Add an "order by" clause for a timestamp to the query.
     *
     * @param string $column
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function oldest($column = null);

    /**
     * Create a collection of models from plain arrays.
     *
     * @param array $items
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function hydrate($items);

    /**
     * Create a collection of models from a raw query.
     *
     * @param string $query
     * @param array $bindings
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fromQuery($query, $bindings = []);

    /**
     * Get a single column's value from the first result of a query.
     *
     * @param string $column
     * @return mixed
     */
    public function value($column);

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
     * Get the hydrated models without eager loading.
     *
     * @param array|string $columns
     * @return \Illuminate\Database\Eloquent\Model[]|static[]
     */
    public function getModels($columns = []);

    /**
     * Eager load the relationships for the models.
     *
     * @param array $models
     * @return array
     */
    public function eagerLoadRelations($models);

    /**
     * Get a lazy collection for the given query.
     *
     * @return \Illuminate\Support\LazyCollection
     */
    public function cursor();

    /**
     * Get an array with the values of a given column.
     *
     * @param string $column
     * @param string|null $key
     * @return \Illuminate\Support\Collection
     */
    public function pluck($column, $key = null);

    /**
     * Paginate the given query.
     *
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = array(), $pageName = 'page', $page = null);

    /**
     * Paginate the given query into a simple paginator.
     *
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function simplePaginate($perPage = null, $columns = array(), $pageName = 'page', $page = null);

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes);

    /**
     * Save a new model and return the instance. Allow mass-assignment.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function forceCreate($attributes);

    /**
     * Register a replacement for the default delete function.
     *
     * @param \Closure $callback
     * @return void
     */
    public function onDelete($callback);

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
     * @param bool $force
     * @return mixed
     */
    public function delete($force = false);

    /**
     * @return mixed
     */
    public function forceDelete();

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $input
     * @param null $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter($input, $filter = null);

    /**
     * @param $columns
     * @return int
     */
    public function count($columns = ['*']);

    /**
     * Get the relationships being eagerly loaded.
     *
     * @return array
     */
    public function getEagerLoads();

    /**
     * Get the given macro by name.
     *
     * @param string $name
     * @return \Closure
     */
    public function getMacro($name);

    /**
     * Checks if a macro is registered.
     *
     * @param string $name
     * @return bool
     * @static
     */
    public function hasMacro($name);

    /**
     * Get the given global macro by name.
     *
     * @param string $name
     * @return \Closure
     */
    public function getGlobalMacro($name);

    /**
     * Checks if a global macro is registered.
     *
     * @param string $name
     * @return bool
     * @static
     */
    public function hasGlobalMacro($name);

    /**
     * Apply the callback's query changes if the given "value" is true.
     *
     * @param mixed $value
     * @param callable $callback
     * @param callable|null $default
     * @return mixed|$this
     */
    public function when($value, $callback, $default = null);

    /**
     * Get the count of the total records for the paginator.
     *
     * @param array $columns
     * @return int
     */
    public function getCountForPagination($columns = []);

    /**
     * Determine if any rows exist for the current query.
     *
     * @return bool
     */
    public function exists();

    /**
     * Determine if no rows exist for the current query.
     *
     * @return bool
     */
    public function doesntExist();

    /**
     * Execute the given callback if no rows exist for the current query.
     *
     * @param \Closure $callback
     * @return mixed
     */
    public function existsOr($callback);

    /**
     * Execute the given callback if rows exist for the current query.
     *
     * @param \Closure $callback
     * @return mixed
     */
    public function doesntExistOr($callback);

    /**
     * Retrieve the minimum value of a given column.
     *
     * @param string $column
     * @return mixed
     */
    public function min($column);

    /**
     * Retrieve the maximum value of a given column.
     *
     * @param string $column
     * @return mixed
     */
    public function max($column);

    /**
     * Retrieve the sum of the values of a given column.
     *
     * @param string $column
     * @return mixed
     */
    public function sum($column);

    /**
     * Retrieve the average of the values of a given column.
     *
     * @param string $column
     * @return mixed
     */
    public function avg($column);

    /**
     * Alias for the "avg" method.
     *
     * @param string $column
     * @return mixed
     */
    public function average($column);

    /**
     * Execute an aggregate function on the database.
     *
     * @param string $function
     * @param array $columns
     * @return mixed
     */
    public function aggregate($function, $columns = []);

    /**
     * Execute a numeric aggregate function on the database.
     *
     * @param string $function
     * @param array $columns
     * @return float|int
     */
    public function numericAggregate($function, $columns = []);

    /**
     * Insert a new record into the database.
     *
     * @param array $values
     */
    public function insert($values);

    /**
     * Insert a new record into the database while ignoring errors.
     *
     * @param array $values
     * @return int
     */
    public function insertOrIgnore($values);

    /**
     * Insert a new record and get the value of the primary key.
     *
     * @param array $values
     * @param string|null $sequence
     * @return int
     */
    public function insertGetId($values, $sequence = null);

    /**
     * Insert new records into the table using a subquery.
     *
     * @param array $columns
     * @param \Closure|\Illuminate\Database\Query\Builder|string $query
     * @return int
     */
    public function insertUsing($columns, $query);

    /**
     * Insert or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return bool
     */
    public function updateOrInsert($attributes, $values = []);

    /**
     * Run a truncate statement on the table.
     *
     * @return void
     */
    public function truncate();

    /**
     * Create a raw database expression.
     *
     * @param mixed $value
     * @return \Illuminate\Database\Query\Expression
     */
    public function raw($value);

    /**
     * Get the current query value bindings in a flattened array.
     *
     * @return array
     */
    public function getBindings();

    /**
     * Get the raw array of bindings.
     *
     * @return array
     */
    public function getRawBindings();

    /**
     * Get the database query processor instance.
     *
     * @return \Illuminate\Database\Query\Processors\Processor
     */
    public function getProcessor();

    /**
     * Get the query grammar instance.
     *
     * @return \Illuminate\Database\Query\Grammars\Grammar
     */
    public function getGrammar();

    /**
     * Clone the query without the given properties.
     *
     * @param array $properties
     * @return static
     */
    public function cloneWithout($properties);

    /**
     * Clone the query without the given bindings.
     *
     * @param array $except
     * @return static
     */
    public function cloneWithoutBindings($except);
}

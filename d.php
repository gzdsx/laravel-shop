<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/20
 * Time: 4:22 上午
 */

/**
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
 */
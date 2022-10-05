<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class LiveFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param $q
     * @return LiveFilter
     */
    public function q($q)
    {
        return $this->where('title', 'like', "%$q%");
    }

    /**
     * @param $state
     * @return $this
     */
    public function state($state)
    {
        if (is_numeric($state)) {
            return $this->where('state', $state);
        }

        return $this->whereIn('state', explode(',', $state));
    }
}

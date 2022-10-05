<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TalentCompanyFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function authState($state)
    {
        return $this->where('auth_state', $state);
    }

    public function name($name)
    {
        return $this->where('name', 'like', "%$name%");
    }
}

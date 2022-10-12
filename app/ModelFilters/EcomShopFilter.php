<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class EcomShopFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function authState($auth_state)
    {
        if (is_numeric($auth_state)) {
            return $this->where('auth_state', $auth_state);
        }

        return $this;
    }

    public function closed($closed)
    {
        return $this->where('closed', $closed);
    }
}

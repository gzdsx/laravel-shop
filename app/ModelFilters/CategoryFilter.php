<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CategoryFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function taxonomy($taxonomy)
    {
        return $this->where('taxonomy', $taxonomy);
    }

    public function parent($parent)
    {
        return $this->where('parent_id', $parent);
    }

    public function relations($relations)
    {
        return $this->with($relations);
    }
}

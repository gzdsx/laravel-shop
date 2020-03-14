<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class PostItemFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function title($title)
    {
        return $this->where('title', 'LIKE', "%$title%");
    }

    public function username($username)
    {
        return $this->whereHas('user', function (Builder $builder) use ($username) {
            return $builder->where('username', 'LIKE', "%$username%");
        });
    }

    public function catid($catid)
    {
        return $this->where('catid', $catid);
    }

    public function state($state)
    {
        if (is_numeric($state)) {
            return $this->where('state', $state);
        }
        return $this;
    }

    public function type($type)
    {
        return $this->where('type', $type);
    }

    public function timeBegin($time)
    {
        if ($time) {
            return $this->where('created_at', '>', strtotime($time));
        }
        return $this;
    }

    public function timeEnd($time)
    {
        if ($time) {
            return $this->where('created_at', '<', strtotime($time) + 86400);
        }
        return $this;
    }

    public function q($q)
    {
        return $this->where('title', 'LIKE', "%$q%");
    }
}

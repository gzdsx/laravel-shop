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

    /**
     * @param $username
     * @return PostItemFilter|Builder
     */
    public function username($username)
    {
        return $this->whereHas('user', function (Builder $builder) use ($username) {
            return $builder->where('username', 'LIKE', "%$username%");
        });
    }

    /**
     * @param $catid
     * @return $this|PostItemFilter
     */
    public function catid($catid)
    {
        if ($catid > 0) {
            return $this->where('catid', $catid);
        } else {
            return $this;
        }
    }

    /**
     * @param $state
     * @return $this|PostItemFilter
     */
    public function state($state)
    {
        if (is_numeric($state)) {
            return $this->where('state', $state);
        }
        return $this;
    }

    /**
     * @param $type
     * @return PostItemFilter
     */
    public function type($type)
    {
        return $this->where('type', $type);
    }

    /**
     * @param $time
     * @return $this|PostItemFilter
     */
    public function timeBegin($time)
    {
        return $this->whereDate('created_at', '', $time);
    }

    /**
     * @param $time
     * @return $this|PostItemFilter
     */
    public function timeEnd($time)
    {
        return $this->whereDate('created_at', '<', date('Y-m-d',strtotime($time) + 86400));
    }

    /**
     * @param $q
     * @return PostItemFilter
     */
    public function q($q)
    {
        return $this->where('title', 'LIKE', "%$q%");
    }
}

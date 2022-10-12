<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Date;

class CommonMaterialFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function uid($uid)
    {
        return $this->where('uid', '=', $uid);
    }

    public function username($username)
    {
        return $this->with(['user' => function ($query) use ($username) {
            return $query->where('username', 'like', "%$username%");
        }]);
    }

    public function type($type)
    {
        return $this->where('type', $type);
    }

    public function name($name)
    {
        return $this->where('name', 'like', "%$name%");
    }

    public function timeBegin($time)
    {
        return $this->whereDate('created_at', '>', Date::make($time));
    }

    public function timeEnd($time)
    {
        return $this->whereDate('created_at', '<', Date::make($time));
    }
}

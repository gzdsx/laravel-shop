<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Date;

class UserFilter extends ModelFilter
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
        return $this->where('username', 'like', "%$username%");
    }

    public function mobile($mobile)
    {
        return $this->where('mobile', '=', $mobile);
    }

    public function email($email)
    {
        return $this->where('email', '=', $email);
    }

    public function gid($gid)
    {
        return $this->where('gid', $gid);
    }

    public function timeBegin($time)
    {
        return $this->whereDate('created_at', '>=', Date::make($time));
    }

    public function timeEnd($time)
    {
        return $this->whereDate('created_at', '<=', Date::make($time));
    }

    public function state($state)
    {
        if (is_numeric($state)) {
            return $this->where('state', $state);
        }

        return $this;
    }
}

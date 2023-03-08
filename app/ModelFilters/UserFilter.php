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

    public function nickname($name)
    {
        return $this->where('nickname', 'like', "%$name%");
    }

    public function phone($phone)
    {
        return $this->where('phone', '=', $phone);
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

    public function status($status)
    {
        if (is_numeric($status)) {
            return $this->where('status', $status);
        }

        return $this;
    }
}

<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ShopFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    protected function tab($tab){
        if ($tab == 'opening'){
            return $this->where('closed', 0);
        }

        if ($tab == 'closed'){
            return $this->where('closed', 1);
        }

        return $this;
    }

    /**
     * @param $name
     * @return ShopFilter
     */
    public function shopName($name){
        return $this->where('shop_name','like',"%$name%");
    }

    /**
     * @param $username
     * @return ShopFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function username($username){
        return $this->whereHas('user', function ($query) use ($username){
            return $query->where('username','like',"%$username%");
        });
    }

    public function phone($phone){
        return $this->where('phone', '=', $phone);
    }

    public function shopState($state){
        if ($state == 'opening'){
            return $this->where('closed', 0);
        }

        if ($state == 'closed'){
            return $this->where('closed', 1);
        }

        return $this;
    }

    public function timeBegin($time){
        if ($time){
            return $this->where('time_begin', '>', strtotime($time));
        }
        return $this;
    }

    public function timeEnd($time){
        if ($time){
            return $this->where('time_begin', '<', strtotime($time)+86400);
        }
        return $this;
    }
}

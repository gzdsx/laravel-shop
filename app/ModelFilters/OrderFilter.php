<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;

class OrderFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function tab($tab)
    {
        if ($tab == 'waitPay') {
            return $this->where('order_state', 0);
        }
        if ($tab == 'waitSend') {
            return $this->where('order_state', 1);
        }
        if ($tab == 'waitConfirm') {
            return $this->where('order_state', 2);
        }
        if ($tab == 'waitRate') {
            return $this->where('order_state', 3)->where('buyer_rate', 0);
        }
        if ($tab == 'refunding') {
            return $this->where('order_state', 10);
        }
        if ($tab == 'closed') {
            return $this->where('order_state', 20);
        }

        if ($tab == 'completed') {
            return $this->where('order_state', 3);
        }
        return $this;
    }

    public function orderNo($order_no)
    {
        return $this->where('order_no', $order_no);
    }

    public function shopName($name)
    {
        return $this->where('shop_name', 'LIKE', "%$name%");
    }

    public function keyword($keyword)
    {
        return $this->whereHas('items', function (Builder $query) use ($keyword) {
            return $query->where('title', 'LIKE', "%$keyword%");
        });
    }

    public function title($title)
    {
        return $this->whereHas('items', function (Builder $query) use ($title) {
            return $query->where('title', 'LIKE', "%$title%");
        });
    }

    public function orderState($state)
    {
        if ($state) {
            return $this->where('order_state', $state);
        }
        return $this;
    }

    public function buyerRate($rate)
    {
        return $this->where('buyer_rate', $rate);
    }

    public function sellerRate($rate)
    {
        return $this->where('seller_rate', $rate);
    }

    public function tabCode($code)
    {
        if ($code == 'waitPay') {
            return $this->where('order_state', 1);
        }
        if ($code == 'waitSend') {
            return $this->where('order_state', 2);
        }
        if ($code == 'waitConfirm') {
            return $this->where('order_state', 3);
        }
        if ($code == 'waitRate') {
            return $this->where('order_state', 4)->where('buyer_rate', 0);
        }
        if ($code == 'refunding') {
            return $this->where('order_state', 5);
        }
        if ($code == 'closed') {
            return $this->where('order_state', 6);
        }

        return $this;
    }

    public function buyerName($name)
    {
        return $this->where('buyer_name', 'LIKE', "%$name%");
    }

    public function sellerName($name)
    {
        return $this->where('seller_name', 'LIKE', "%$name%");
    }

    /**
     * @param $type
     * @return OrderFilter
     */
    public function payType($type)
    {
        return $type ? $this->where('pay_type', $type) : $this;
    }

    /**
     * @param $time
     * @return OrderFilter|\Illuminate\Database\Query\Builder
     */
    public function timeBegin($time)
    {
        return $this->whereDate('created_at', '>=', Date::make($time));
    }

    /**
     * @param $time
     * @return OrderFilter|\Illuminate\Database\Query\Builder
     */
    public function timeEnd($time)
    {
        return $this->whereDate('created_at', '<=', Date::make($time));
    }
}

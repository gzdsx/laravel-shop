<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

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
            return $this->where('order_state', 1);
        } elseif ($tab == 'waitSend') {
            return $this->where('order_state', 2);
        } elseif ($tab == 'send') {
            return $this->where('order_state', 3);
        } elseif ($tab == 'received') {
            return $this->where('order_state', 4);
        } elseif ($tab == 'success') {
            return $this->where('order_state', 4);
        } elseif ($tab == 'refunding') {
            return $this->where('order_state', 5);
        } elseif ($tab == 'closed') {
            return $this->where('order_state', 6);
        }
        return $this;
    }

    public function orderNo($order_no){
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

    public function title($title){
        return $this->whereHas('items', function (Builder $query) use ($title) {
            return $query->where('title', 'LIKE', "%$title%");
        });
    }

    public function orderState($state)
    {
        return $this->where('order_state', $state);
    }

    public function buyerRate($rate)
    {
        return $this->where('buyer_rate', $rate);
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

    public function buyerName($name){
        return $this->where('buyer_name', 'LIKE', "%$name%");
    }

    public function sellerName($name){
        return $this->where('seller_name', 'LIKE', "%$name%");
    }

    /**
     * @param $type
     * @return OrderFilter
     */
    public function payType($type){
        return $type ? $this->where('pay_type', $type) : $this;
    }

    public function timeBegin($time){
        if ($time){
            return $this->where('created_at', '>', strtotime($time));
        }
        return $this;
    }

    public function timeEnd($time){
        if ($time){
            return $this->where('created_at', '<', strtotime($time));
        }

        return $this;
    }
}

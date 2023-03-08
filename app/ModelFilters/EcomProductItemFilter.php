<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class EcomProductItemFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function cate($cate_id)
    {
        if ($cate_id) {
            return $this->where('cate_id', $cate_id);
        }
        return $this;
    }

    /**
     * @param $q
     * @return EcomProductItemFilter
     */
    public function q($q)
    {
        return $this->where('title', 'like', "%$q%");
    }

    public function keywords($q)
    {
        return $this->where('title', 'like', "%$q%");
    }

    /**
     * @param $uid
     * @return EcomProductItemFilter
     */
    public function seller($seller_id)
    {
        return $this->where('seller_id', $seller_id);
    }

    /**
     * @param $name
     * @return EcomProductItemFilter|Builder
     */
    public function sellerName($name)
    {
        return $this->related('seller', 'nickname', 'like', "%$name%");
    }

    /**
     * @param $state
     * @return $this
     */
    public function state($state)
    {
        if (is_numeric($state)) {
            return $this->where('state', $state);
        } else {
            if ($state == 'on_sale') {
                return $this->where('state', 1);
            }
            if ($state == 'off_sale') {
                return $this->where('state', 0);
            }
        }

        return $this;
    }

    /**
     * @param $title
     * @return EcomProductItemFilter
     */
    public function title($title)
    {
        return $this->where('title', 'LIKE', "%$title%");
    }

    /**
     * @param $price
     * @return EcomProductItemFilter
     */
    public function minPrice($price)
    {
        return $this->where('price', '>', floatval($price));
    }

    /**
     * @param $price
     * @return $this|EcomProductItemFilter
     */
    public function maxPrice($price)
    {
        return $this->where('price', '<', floatval($price));
    }

    /**
     * @param $itemid
     * @return EcomProductItemFilter
     */
    public function itemid($itemid)
    {
        return $this->where('itemid', $itemid);
    }

    /**
     * @param $sort
     * @return $this|EcomProductItemFilter
     */
    public function sort($sort)
    {
        if ($sort == 'sale-desc') {
            return $this->orderByDesc('sold');
        }

        if ($sort == 'price-asc') {
            return $this->orderBy('price');
        }

        return $this->orderByDesc('itemid');
    }

    /**
     * @param $tab
     * @return $this|EcomProductItemFilter
     */
    public function tab($tab)
    {
        if ($tab == 'onSale') {
            return $this->where('state', 1);
        }

        if ($tab == 'offShelf') {
            return $this->where('state', 0);
        }

        if ($tab == 'soldOut') {
            return $this->where('stock', 0);
        }
        return $this;
    }
}

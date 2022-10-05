<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductItemFilter extends ModelFilter
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
     * @return ProductItemFilter
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
     * @return ProductItemFilter
     */
    public function seller($seller_id)
    {
        return $this->where('seller_id', $seller_id);
    }

    /**
     * @param $name
     * @return ProductItemFilter|Builder
     */
    public function sellerName($name)
    {
        return $this->whereHas('seller', function (Builder $builder) use ($name) {
            return $builder->where('username', 'LIKE', "%$name%");
        });
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
     * @return ProductItemFilter
     */
    public function title($title)
    {
        return $this->where('title', 'LIKE', "%$title%");
    }

    /**
     * @param $price
     * @return ProductItemFilter
     */
    public function minPrice($price)
    {
        return $this->where('price', '>', floatval($price));
    }

    /**
     * @param $price
     * @return $this|ProductItemFilter
     */
    public function maxPrice($price)
    {
        return $this->where('price', '<', floatval($price));
    }

    /**
     * @param $itemid
     * @return ProductItemFilter
     */
    public function itemid($itemid)
    {
        return $this->where('itemid', $itemid);
    }

    /**
     * @param $catid
     * @return $this|ProductItemFilter
     */
    public function catid($catid)
    {
//        return $this->whereHas('cates', function (Builder $builder) use ($catid) {
//            return $builder->where('catid', $catid);
//        });
        if ($catid) {
            return $this->where('catid', $catid);
        }

        return $this;
    }

    /**
     * @param $sort
     * @return $this|ProductItemFilter
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
     * @return $this|ProductItemFilter
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

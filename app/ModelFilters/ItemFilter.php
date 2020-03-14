<?php namespace App\ModelFilters;


use App\Repositories\Eloquent\ItemCatlogRepository;
use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

class ItemFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function q($q)
    {
        return $this->where('title', 'like', "%$q%");
    }

    public function keywords($q)
    {
        return $this->where('title', 'like', "%$q%");
    }

    public function uid($uid)
    {
        return $this->where('uid', $uid);
    }

    public function shopName($name)
    {
        return $this->whereHas('shop', function (Builder $builder) use ($name) {
            return $builder->where('shop_name', 'LIKE', "%$name%");
        });
    }

    public function shop($shop)
    {
        return $this->where('shop_id', '=', $shop);
    }

    public function sellerName($name)
    {
        return $this->whereHas('user', function (Builder $builder) use ($name) {
            return $builder->where('username', 'LIKE', "%$name%");
        });
    }

    public function saleState($state)
    {
        if ($state == 'on_sale') {
            return $this->where('on_sale', 1);
        }
        if ($state == 'off_sale') {
            return $this->where('on_sale', 0);
        }

        return $this;
    }

    public function title($title)
    {
        return $this->where('title', 'LIKE', "%$title%");
    }

    public function minPrice($price)
    {
        if ($price) {
            return $this->where('price', '>', floatval($price));
        }
        return $this;
    }

    public function maxPrice($price)
    {
        if ($price) {
            return $this->where('price', '<', floatval($price));
        }
        return $this;
    }

    public function itemid($itemid)
    {
        return $this->where('itemid', $itemid);
    }

    public function catid($catid)
    {
        if ($catid) {
            return $this->whereIn('catid', app(ItemCatlogRepository::class)->fetchAllIds($catid));
        }
        return $this;
    }

    /**
     * @param $sort
     * @return $this|ItemFilter
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

    public function tab($tab)
    {
        if ($tab == 'onSale') {
            return $this->where('on_sale', 1);
        }

        if ($tab == 'offShelf') {
            return $this->where('on_sale', 1);
        }

        if ($tab == 'soldOut') {
            return $this->where('stock', 0);
        }
        return $this;
    }

    public function type($type){
        return $this->where('type', $type);
    }
}

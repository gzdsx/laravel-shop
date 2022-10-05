<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Models\Order;
use App\Traits\Trade\SoldTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SoldController extends BaseController
{
    use SoldTrait, HasEcomShopSession;

    protected function repository()
    {
        return Order::withGlobalScope('avalaible', function (Builder $builder) {
            return $builder->where('seller_deleted', 0)->where('shop_id', $this->shop()->shop_id);
        });
    }
}

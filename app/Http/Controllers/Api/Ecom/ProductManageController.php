<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomProductItem;
use App\Traits\Ecom\EcomProductTrait;
use Illuminate\Http\Request;

class ProductManageController extends BaseController
{
    use HasEcomShopSession, EcomProductTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|EcomProductItem
     */
    protected function repository()
    {
        return $this->shop()->products();
    }

}

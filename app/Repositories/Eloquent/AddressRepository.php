<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 17:38
 */

namespace App\Repositories\Eloquent;


use App\Models\Address;
use App\Repositories\Contracts\AddressRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return Address::class;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return Auth::user()->addresses()->create($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function getDefaultAddress()
    {
        // TODO: Implement getDefaultAddress() method.
        return Auth::user()->addresses()->orderByDesc('isdefault')->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Address
 *
 * @property int $address_id
 * @property int $uid
 * @property string|null $name
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $street
 * @property string|null $postalcode
 * @property int $isdefault
 * @property-read string $full_address
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUid($value)
 * @mixin \Eloquent
 */
class UserAddress extends Model
{
    protected $table = 'user_address';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'uid', 'name', 'tel', 'province', 'city', 'district', 'street', 'postalcode', 'isdefault'
    ];
    protected $appends = ['full_address'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (UserAddress $address) {
            if ($address->uid) $address->uid = Auth::id();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->province . $this->city . $this->district . $this->street;
    }
}
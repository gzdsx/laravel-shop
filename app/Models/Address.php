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
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUid($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'uid', 'name', 'tel', 'province',
        'city', 'district', 'street', 'postalcode', 'isdefault'
    ];
    protected $appends = ['addressText'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (Address $address) {
            $address->uid = Auth::id();
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
    public function getAddressTextAttribute()
    {
        return $this->attributes['province'] . $this->attributes['city'] . $this->attributes['district'] . $this->attributes['street'];
    }
}

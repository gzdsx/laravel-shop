<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\DeviceToken
 *
 * @property int $id
 * @property int $uid
 * @property string $device_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereDeviceToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereUid($value)
 * @mixin \Eloquent
 */
class DeviceToken extends Model
{
    protected $table = 'device_token';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'device_token'];

    public $timestamps = false;
}

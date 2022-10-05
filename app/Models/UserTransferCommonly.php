<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTransferCommonly
 *
 * @property int $id
 * @property int $uid
 * @property int $payee_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly wherePayeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransferCommonly whereUid($value)
 * @mixin \Eloquent
 */
class UserTransferCommonly extends Model
{
    //use HasFactory;

    protected $table = 'user_transfer_commonly';
    protected $fillable = ['uid', 'payee_id'];
    public $timestamps = false;
}

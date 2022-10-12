<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserCommissionLog
 *
 * @property-read \App\Models\User|null $payer
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCommissionLog query()
 * @mixin \Eloquent
 */
class UserCommissionLog extends Model
{
    use HasDates;

    protected $table = 'user_commission_log';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'payer_id', 'amount', 'balance', 'type', 'detail'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'uid');
    }
}

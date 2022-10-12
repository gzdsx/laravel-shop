<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserWithrawalLog
 *
 * @property-read array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $state_des
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWithrawalLog query()
 * @mixin \Eloquent
 */
class UserWithrawalLog extends Model
{
    use HasDates;

    protected $table = 'user_withdrawal_log';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'amount', 'state'];
    protected $appends = ['state_des'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getStateDesAttribute()
    {
        return trans('withdraw.states.' . $this->state);
    }
}

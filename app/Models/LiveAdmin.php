<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LiveAdmin
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $remark 备注
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LiveAdmin extends Model
{
    use HasDates;
    protected $table = 'live_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'remark'];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

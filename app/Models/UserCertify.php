<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserAuth
 *
 * @property int $uid 用户ID
 * @property string|null $name 姓名
 * @property string|null $id_card_no 身份证号
 * @property string|null $id_card_front 身份证正面
 * @property string|null $id_card_back 身份证背面
 * @property string|null $id_card_hand 手持身份证
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCertify whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserCertify extends Model
{
    use HasDates;

    protected $table = 'user_certify';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'name', 'id_card_no', 'id_card_front', 'id_card_back', 'id_card_hand'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

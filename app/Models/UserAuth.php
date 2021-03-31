<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserAuth
 *
 * @property int $uid 用户ID
 * @property string|null $name 姓名
 * @property string|null $pin 身份证号
 * @property string $id_front 身份证正面
 * @property string $id_back 身份证背面
 * @property string $id_hand 手持身份证
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereIdHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuth whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserAuth extends Model
{
    use HasDates;
    protected $table = 'user_auth';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'name', 'pin', 'id_front', 'id_back', 'id_hand'];

    /**
     * @param $value
     * @return string
     */
    public function getIdFrontAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdFrontAttribute($value)
    {
        $this->attributes['id_front'] = strip_image_url($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIdBackAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdBackAttribute($value)
    {
        $this->attributes['id_back'] = strip_image_url($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIdHandAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdHandAttribute($value)
    {
        $this->attributes['id_hand'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserAuth
 *
 * @property int $uid 用户ID
 * @property string|null $name 姓名
 * @property string|null $id_card_no 身份证号
 * @property string $id_card_front 身份证正面
 * @property string $id_card_back 身份证背面
 * @property string $id_card_hand 手持身份证
 * @property int $auth_state 认证状态
 * @property mixed $created_at 创建时间
 * @property mixed $updated_at 更新时间
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardHand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAuth whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserAuth extends Model
{
    protected $table = 'user_auth';
    protected $primaryKey = 'uid';
    protected $dateFormat = 'U';
    protected $casts = [
        'created_at'=>'datetime:Y-m-d H:i:s',
        'updated_at'=>'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'uid','name','id_card_no','id_card_front',
        'id_card_back','id_card_hand','auth_state','created_at','updated_at'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getIdCardFrontAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdCardFrontAttribute($value)
    {
        $this->attributes['id_card_front'] = str_replace(material_url(), '', $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIdCardBackAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdCardBackAttribute($value)
    {
        $this->attributes['id_card_back'] = str_replace(material_url(), '', $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIdCardHandAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIdCardHandAttribute($value)
    {
        $this->attributes['id_card_hand'] = str_replace(material_url(), '', $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

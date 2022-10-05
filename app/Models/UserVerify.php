<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string|null $code 验证码
 * @property string|null $phone 手机号
 * @property string|null $email 邮箱
 * @property int $used 已使用
 * @property \Illuminate\Support\Carbon|null $created_at 发送时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerify whereUsed($value)
 * @mixin \Eloquent
 */
class UserVerify extends Model
{
    protected $table = 'user_verify';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'phone', 'email', 'used'];
}

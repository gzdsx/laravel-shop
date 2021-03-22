<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string|null $code 验证码
 * @property string|null $mobile 手机号
 * @property string|null $email 邮箱
 * @property int $used 已使用
 * @property \Illuminate\Support\Carbon|null $created_at 发送时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify query()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUsed($value)
 * @mixin \Eloquent
 */
class Verify extends Model
{
    protected $table = 'verify';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'mobile', 'email', 'used'];
}

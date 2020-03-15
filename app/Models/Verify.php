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
 * @property string|null $created_at 发送时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereUsed($value)
 * @mixin \Eloquent
 */
class Verify extends Model
{
    protected $table = 'verify';
    protected $primaryKey = 'id';
}

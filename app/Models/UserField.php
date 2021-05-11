<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserField
 *
 * @property int $id 主键
 * @property int $uid 用户ID
 * @property string|null $name 字段名
 * @property string|null $value 字段值
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserField whereValue($value)
 * @mixin \Eloquent
 */
class UserField extends Model
{
    protected $table = 'user_field';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'name', 'value'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

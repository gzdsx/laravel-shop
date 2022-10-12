<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommonKefu
 *
 * @property int $id 主键
 * @property string|null $title 标题
 * @property string|null $phone 电话
 * @property string|null $weixin 微信
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonKefu whereWeixin($value)
 * @mixin \Eloquent
 */
class CommonKefu extends Model
{
    //use HasFactory;
    use HasDates;

    protected $table = 'common_kefu';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'phone', 'weixin'];
}

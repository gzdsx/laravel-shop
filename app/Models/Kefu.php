<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kefu
 *
 * @property int $id 主键
 * @property string|null $title 标题
 * @property string|null $phone 电话
 * @property string|null $weixin 微信
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kefu whereWeixin($value)
 * @mixin \Eloquent
 */
class Kefu extends Model
{
    //use HasFactory;
    use HasDates;

    protected $table = 'kefu';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'phone', 'weixin'];
}

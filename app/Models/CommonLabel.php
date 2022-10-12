<?php

namespace App\Models;

use App\Models\Traits\HasDates;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommonLabel
 *
 * @property int $id 主键
 * @property string|null $title 名称
 * @property string|null $content 内容
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonLabel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommonLabel extends Model
{
    use HasDates;

    protected $table = 'common_label';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content', 'state'];


    public static function updateCache()
    {
        $labels = CommonLabel::whereState(1)->get()->pluck('content', 'id');
        cache()->forever('labels', $labels);
    }
}

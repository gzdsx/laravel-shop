<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Label
 *
 * @property int $id 主键
 * @property string|null $title 名称
 * @property string|null $content 内容
 * @property int $state 状态
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|Label newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label query()
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Label extends Model
{
    protected $table = 'label';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content', 'state'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public static function updateCache()
    {
        $labels = Label::whereState(1)->get()->pluck('content', 'id');
        cache()->forever('labels', $labels);
    }
}

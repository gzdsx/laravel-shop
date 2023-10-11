<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PageMeta
 *
 * @property int $meta_id
 * @property int $page_id
 * @property string|null $meta_key
 * @property string|null $meta_value
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta whereMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageMeta wherePageId($value)
 * @mixin \Eloquent
 */
class PageMeta extends Model
{
    protected $table = 'page_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable = ['page_id', 'meta_key', 'meta_value'];

    public $timestamps = false;
}

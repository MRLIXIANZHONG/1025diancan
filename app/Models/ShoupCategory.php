<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShoupCategory
 *
 * @property int $id
 * @property string $name 分类名
 * @property string $img 分类图片
 * @property int $status 状态：1显示，0隐藏
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShoupCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShoupCategory extends Model
{
    //允许更改的字段
    protected $fillable=[
        'name','img','status'
    ];
}

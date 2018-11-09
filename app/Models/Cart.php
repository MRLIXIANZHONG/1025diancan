<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $user_id 会员id
 * @property int $menu_id 商品id
 * @property int $nums 商品数量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Menu $menus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereNums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUserId($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    //允许修改的字段
    protected $fillable=[
        'user_id','menu_id','nums',
    ];

    //跟商品表建立多对多关系
    public function menus(){

      return $this->belongsTo(Menu::class,'menu_id');
    }
}

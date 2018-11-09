<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuCategory
 *
 * @property int $id
 * @property string $name 名称
 * @property string $type_accumulation 菜品编号a-z前端使用
 * @property string $shop_id 所属商家ID
 * @property string $description 描述
 * @property int $is_selected 是否为默认菜品 0不是 1是
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $menus
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereIsSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereTypeAccumulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MenuCategory extends Model
{
    //允许更改的字段
    protected $fillable=[
       'name','type_accumulation','shop_id','description',
        'is_selected'
    ];

    //跟店铺表建立一对多关系
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
    //跟菜品建立一对多关系
    public function menus(){
        return $this->hasMany(Menu::class,'category_id');
    }

}

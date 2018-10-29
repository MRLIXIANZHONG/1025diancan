<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

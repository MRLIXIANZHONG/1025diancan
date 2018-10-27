<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //允许更改的字段
    protected $fillable=[
      'goods_name','rating','shop_id','category_id','goods_price',
        'description','month_sales','rating_count','tips','satisfy_count',
        'satisfy_rate','goods_img','status'
    ];

    //与菜品分类建立一对多关系
    public function menucate(){
        return $this->belongsTo(MenuCategory::class,'category_id');
    }
}

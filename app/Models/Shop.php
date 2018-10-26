<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //允许更改的字段
    protected $fillable=[
        'shop_category_id','shop_name','shop_img',
        'shop_rating','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','send_cost',
        'notice','discount','status','user_id',
    ];

    public function shopcate(){

        return $this->belongsTo(ShoupCategory::class,'shop_category_id');
    }
    //建立商家一对一关系
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //允许修改的字段
    protected $fillable=[
        'order_id','goods_id','amount','goods_name','goods_img','goods_price',
    ];
}

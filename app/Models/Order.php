<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //声明一个静态属性，来存储订单状态，给下面的获取器用
    static public $statusText=[-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];

    //允许更改的字段
    protected $fillable=[
      'order_code','order_birth_time','order_status','shop_id','shop_name',
      'shop_img','order_price','order_address','province','city','county',
        'tel','name','user_id'
    ];

    /*
     * 用获取器，来实现字段值的更改，也可以定义数据库中不存在的变量
     * get....Attribute  省略号中写字段名，可以是数据库中不存在的，
     * 数据表中，多个单词的字段，是有下划线来链接，这里用大驼峰链接
     *
     * getOrderStatusAttribute  代表的是数据表中order_status字段
     *
     * 当控制器中调用这个字段就好触发这个获取器方法，获取器可以传参数
     * */
    public function getStatusAttribute()
    {
            //用了上面的静态属性
        return self::$statusText[$this->order_status];//-1 0 1 2 3
    }

    //跟订单商品表建立一对多关系
    public function orderDeta(){

        return $this->hasMany(OrderDetail::class,'order_id');
    }


}

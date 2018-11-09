<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop
 *
 * @property int $id
 * @property int $shop_category_id 店铺分类id
 * @property string $shop_name 店铺名称
 * @property string $shop_img 店铺图片
 * @property float $shop_rating 评分
 * @property int $brand 是否是品牌 0不是 1是
 * @property int $on_time 是否准时送达 0不是 1 是
 * @property int $fengniao 是否蜂鸟配送 0不是1是
 * @property int $bao 是否保标记 0不是 1是
 * @property int $piao 是否票标记 0不是 1是
 * @property int $zhun 是否准标记 0不是 1是
 * @property float $start_send 起送金额
 * @property float $send_cost 配送费
 * @property string $notice 店公告
 * @property string $discount 优惠信息
 * @property int $status 状态:1正常,0待审核,-1禁用
 * @property int $user_id 所属商家
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ShoupCategory $shopcate
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereBao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereFengniao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereOnTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop wherePiao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereSendCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereStartSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereZhun($value)
 * @mixin \Eloquent
 */
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

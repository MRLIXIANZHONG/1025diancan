<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $goods_name 菜名称
 * @property float $rating 评分
 * @property int $shop_id 所属商家ID
 * @property int $category_id 所属分类ID
 * @property float $goods_price 价格
 * @property string $description 描述
 * @property int $month_sales 	月销量
 * @property int $rating_count 评分数量
 * @property string $tips 提示信息
 * @property int $satisfy_count 满意度数量
 * @property float $satisfy_rate 满意度评分
 * @property string $goods_img 商品图片
 * @property int $status 状态：1上架，0下架
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MenuCategory $menucate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereGoodsImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereGoodsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereGoodsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereMonthSales($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSatisfyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSatisfyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereTips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

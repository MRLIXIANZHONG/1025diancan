<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //添加购物车
    public function add(Request $request)
    {
        //接受数据
        $user_id = $request->post('user_id');
        //先清除购物车
        Cart::where('user_id',$user_id)->delete();
        //商品id
        $menus = $request->post('goodsList');
        //商品数量
        $nums = $request->post('goodsCount');
        //由于商品id和数量是一一对应的
        //循环遍历商品
        foreach ($menus as $k => $menu) {
            $value[$k] = [
                'user_id'=>$user_id,
                'menu_id' => $menu,
                'nums' => $nums[$k],

            ];
            Cart::create($value[$k]);

        }
       $data = [
           'status'=>'true',
           'message'=>'添加成功'
       ];
        return $data;


    }

    //购物车
    public function cart(Request $request){

        //接受会员id
        $user_id = $request->get('user_id');
        //查询购物车中所有属于会员的商品
        $menus = Cart::where('user_id',$user_id)->get();
        //dd($menus[0]->menus->goods_name);
        $const=0;
//        循环遍历商品
        foreach ($menus as $k=>$menu){

            $values[$k]=[
                'goods_id'=>$menu->menu_id,
                'goods_name'=>$menu->menus->goods_name,
                'goods_img'=>$menu->menus->goods_img,
                'amount'=>$menu->nums,
                'goods_price'=>$menu->menus->goods_price,
            ];
            //钱
            $const += $values[$k]['amount']*$values[$k]['goods_price'];
        }
        $data=[
           'goods_list'=> $values,
            'totalCost'=>$const,
            ];

      return $data;


    }




}

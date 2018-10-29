<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //显示接口主页
    public function index(){
        header("Access-Control-Allow-Origin: *");

        $shops = Shop::all();
        //dd($shops->toArray());
        foreach ($shops as $k=>$v){
            $shops[$k]->distance=rand(1000,5000);
            $shops[$k]->estimate_time=ceil($shops[$k]->distance/100);
        }

        return $shops;
    }

    public function menuList(Request $request){

        //得到当前店铺的id
        $id =$request->get('id');

        //查找当前店铺的菜品
        $shop = Shop::find($id);
        $shop->evaluate=[
            [
                "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 1,
                "send_time"=> 30,
                "evaluate_details"=> "不怎么好吃"
            ],
            [
                "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 4.5,
                "send_time"=> 30,
                "evaluate_details"=> "很好吃"
            ],
            [
                "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 4.7,
                "send_time"=> 30,
                "evaluate_details"=> "很好吃"
            ],
        ];

        //得到当前商品的菜单
        $menucates = MenuCategory::where('shop_id',$id)->get();
        //得到当前菜单下的菜品
        foreach ($menucates as $k=>$v){

            $menucates[$k]->goods_list=$v->menus;

        }
        $shop->commodity=$menucates;

       return $shop;
       //dd($shop->toarrAy());



    }
}

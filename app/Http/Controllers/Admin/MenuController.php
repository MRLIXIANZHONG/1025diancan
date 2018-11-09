<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends BaseController
{
    //菜品销量按日统计
    public function day(Request $request){

//        //查询所有会员
//        $users = User::all();
//
//        //接受值
//       $date = $request->get('date') ? $request->get('date') : date('Y-m-d');
//
//
//
//        //按日统计
//        $days = OrderDetail::select(DB::raw("goods_name,
//		SUM(amount) AS count,DATE_FORMAT(created_at, '%Y-%m-%d') as date"))->where('created_at','like',"%$date%");
//
//
//
//        //判断是否传了用户
//        $user_id = $request->get('user_id');
//
//        if ($user_id!=null){
//            //如果存在，就找出对应的店铺
//            $user = User::findOrFail($user_id);
//            //得到当前店铺名
//            $shop_name = $user->shop->shop_name;
//            //查看当前用户的店铺，所有商品id
//            $goods_id = Menu::where('shop_id',$user->shop->id)->pluck('id');
//
//            $days = $days->whereIn('goods_id',$goods_id);
//        }
//
//        $days = $days->groupBy('goods_name')
//            ->simplePaginate(7);
//
//
//
//
//        //构造url
//        $url = ['date'=>$date,'user_id'=>$user_id];
//
//
//        return view('admin.menu.day', compact('days', 'shop_name','url','users'));

        //得到当前的月份
        $date = $request->get('date');

        //接受搜索条件
        $user_id = $request->get('user_id');
        //查找所有订单
        $days=OrderDetail::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,count(*) as nums,goods_name"));
        //用于搜索回显搜索条件
        $url=[];
        if ($user_id){
            //通过id 查找会员
            $user = User::findOrFail($user_id);
            //通过会员找到商铺
            $shop = Shop::where('user_id',$user_id)->first();
            //通过商铺找到菜品
            $menus = Menu::where('shop_id',$shop->id)->pluck('id')->toArray();
            //找到在该商铺下的商品
            $days =$days->whereIn('goods_id',$menus);
            $url = ['user_id'=>$user_id];
        }
        //判断是否输入搜索时间
        if ($date){
            $days = $days->where('created_at','like',"%$date%");
            $url=['date'=>$date];
        }
        $days = $days->groupBy('date')->orderBy('date','desc')->simplePaginate(7);


        //查询所有会员
        $users = User::all();
        return view('admin.menu.day', compact('days', 'url','users'));

    }

    //菜品销量按月统计
    public function month(Request $request){

        //得到当前的月份
        $date = $request->get('date');

        //接受搜索条件
        $user_id = $request->get('user_id');
        //查找所有订单
        $months=OrderDetail::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,count(*) as nums,goods_name"));
        //用于搜索回显搜索条件
        $url=[];
        if ($user_id){
            //通过id 查找会员
            $user = User::findOrFail($user_id);
            //通过会员找到商铺
            $shop = Shop::where('user_id',$user_id)->first();
            //通过商铺找到菜品
            $menus = Menu::where('shop_id',$shop->id)->pluck('id')->toArray();
            //找到在该商铺下的商品
            $months =$months->whereIn('goods_id',$menus);
            $url = ['user_id'=>$user_id];
        }
        //判断是否输入搜索时间
        if ($date){
            $months = $months->where('created_at','like',"%$date%");
            $url=['date'=>$date];
        }
        $months = $months->groupBy('date')->orderBy('date','desc')->simplePaginate(7);


        //查询所有会员
        $users = User::all();
        return view('admin.menu.month', compact('months', 'url','users'));

    }

    //商品总统计
    public function sum(Request $request){

        //统计
        $sums = OrderDetail::select(DB::raw("goods_name,
		SUM(amount) AS count"))
            ->groupBy('goods_name')
            ->simplePaginate(7);

        return view('admin.menu.sum', compact('sums', 'shop_name'));
    }







}

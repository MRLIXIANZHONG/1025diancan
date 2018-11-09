<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //月统计
    public function month(Request $request)
    {


        //得到当前的月份,如果没有输入，就是当前时间
        $date = $request->get('date');

        //接受搜索条件
       $user_id = $request->get('user_id');
       //查找所有订单
        $months=Order::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,count(*) as nums,sum(order_price) as moneys,shop_name,order_code"));
        //用于搜索回显搜索条件
        $url=[];
       if ($user_id){
           //通过id 查找会员
            $user = User::findOrFail($user_id);
           //通过会员找店铺
            $months =$months->where('shop_id', $user->shop->id);
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
        return view('admin.order.month', compact('months', 'url','users'));


    }

    //日统计
    public function day(Request $request){

        //得到当前的月份
        $date = $request->get('date');

        //接受搜索条件
        $user_id = $request->get('user_id');
        //查找所有订单
        $days=Order::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,count(*) as nums,sum(order_price) as moneys,shop_name,order_code"));
        //用于搜索回显搜索条件
        $url=[];
        if ($user_id){
            //通过id 查找会员
            $user = User::findOrFail($user_id);
            //通过会员找店铺
            $days =$days->where('shop_id', $user->shop->id);
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
        return view('admin.order.day', compact('days', 'url','users'));




    }

    //总统计
    public function sum(Request $request){



        //统计所有店铺所有订单量和价格
        $sums = Order::select(DB::raw("count(*) as nums,sum(order_price) as moneys"))->first();

        // dd($days);
        //显示视图

        return view('admin.order.orders', compact( 'sums'));


    }


}

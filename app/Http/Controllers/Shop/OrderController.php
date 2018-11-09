<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //商铺订单列表
    public function index(Request $request)
    {

        //得到当前店铺的所有订单
        $orders = Order::where('shop_id', Auth::user()->shop->id)->paginate(7);

        //显示视图
        return view('shop.order.index', compact('orders'));

    }

    //订单发货
    public function status(Request $request, $id)
    {

        //更改订单状态
        $order = Order::find($id);
        //查看当前订单状态
        switch ($order->order_status) {
            case 0://如果是0时，可以取消订单
                $order->order_status = -1;
                $order->save();
                return back()->with('success', '订单取消成功');
                break;
            case 1:
                $order->order_status = 2;
                $order->save();
                return back()->with('success', '发货成功');
                break;
            case 2:
                $order->order_status = 3;
                $order->save();
                return back()->with('success', '收货成功');
                break;
        }

    }

    //订单详情
    public function detail(Request $request, $id)
    {
        $order = Order::find($id);
        //订单状态

        //$order['order_status']=$order->stats;//获取器

        //显示视图
        return view('shop.order.detail', compact('order'));
    }

    //订单总统计
    public function sum(Request $request)
    {

        //得到当前店铺
        $shop_name = User::find(Auth::id())->shop->shop_name;
        // $orders = Order::where('shop_id', Auth::user()->shop->id)->get();

        //统计所有店铺所有订单量和价格
        $sums = Order::select(DB::raw("count(*) as nums,sum(order_price) as moneys"))->where('shop_id',Auth::user()->shop->id)->first();

        // dd($days);
        //显示视图

        return view('shop.order.orders', compact( 'sums', 'shop_name'));


    }

    //订单按月统计
    public function month(Request $request)
    {
        //接受值
        //接受值
        $date = $request->get('date') ? $request->get('date') : date('Y-m');

        //构造url用于回显
        $url = ['date'=>$date];

        //得到当前店铺
        $shop_name = User::find(Auth::id())->shop->shop_name;
        //按月统计
        $months = Order::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m')            as date,
	        COUNT(*) AS nums,
	        SUM(order_price) as moneys"))
            ->where('shop_id', Auth::user()->shop->id)
            ->groupBy('date')->where('created_at','like',"%$date%")->simplePaginate(7);

        return view('shop.order.month', compact('months', 'shop_name','url'));
    }

    //订单按日统计
    public function day(Request $request)
    {
        //接受值
        $date = $request->get('date') ? $request->get('date') : date('Y-m-d H:i:s');


        //构造url
        $url = ['date'=>$date];


        //得到当前店铺
        $shop_name = User::find(Auth::id())->shop->shop_name;
        //按月统计
        $days = Order::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')            as date,
	        COUNT(*) AS nums,
	        SUM(order_price) as moneys"))
            ->where('shop_id', Auth::user()->shop->id)
            ->groupBy('date')->where('created_at','like',"%$date%")->simplePaginate(7);

        return view('shop.order.day', compact('days', 'shop_name','url'));
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Member;
use App\Models\MemberAddress;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mrgoon\AliSms\AliSms;
use PHPUnit\Framework\Exception;

class OrderController extends Controller
{
    //添加订单
    public function addOrder(Request $request)
    {
        //接受参数
        $user_id = $request->post('user_id');
        $addr_id = $request->post('address_id');

        #1.构造订单数据表 数据 $data

        //订单编号
        $data['order_code'] = date('ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        //取出购物车的商品，由于购物车的设计，只能存同一个商铺的商品
        $carts = Cart::where('user_id', $user_id)->get();
        //取出一个商品，来找到商铺信息
        $cart = $carts[0];
        //通过商品id找到商铺id
        $menu = Menu::where('id', $cart->menu_id)->first();
        //商铺id
        $data['shop_id'] = $menu->shop_id;
        //会员id
        $data['user_id'] = $user_id;
        //找到商铺信息
        $shop = Shop::where('id', $data['shop_id'])->first();
        //商铺名字
        $data['shop_name'] = $shop->shop_name;
        //商铺图片
        $data['shop_img'] = $shop->shop_img;
        //查找收货人地址
        $address = MemberAddress::where('id', $addr_id)->first();
        //判断地址是否有误
        if (!count($address)) {
            return [
                "status" => "false",
                "message" => '地址有误',
            ];
        }

        //详细地址
        $data['order_address'] = $address->detail_address;
        //省
        $data['province'] = $address->provence;
        //市
        $data['city'] = $address->city;
        //县
        $data['county'] = $address->area;
        //收货人电话
        $data['tel'] = $address->tel;
        //收货人姓名
        $data['name'] = $address->name;
        //订单总价 = 配送费+商品数量*商品单价
        //循环遍历购物车
        //求和变量
        $const = 0;
        foreach ($carts as $k => $v) {
            //先找到商品
            $menu = Menu::where('id', $v->menu_id)->first();
            //求和
            $const += $v->nums * $menu->goods_price;
        }
        //订单总价 = 配送费+商品数量*商品单价
        $data['order_price'] = $shop->send_cost + $const;


        # 2.构造订单商品表数据 $values
        # 3. 开启事务，同时向 orders 和 order_details表写入数据,最后再请客购物车
        DB::beginTransaction();

        # 4.捕获异常
        try {
            //订单表插入数据
            $order = Order::create($data);
            // 循环遍历购物车里面的商品
            foreach ($carts as $k => $menu) {

                $values = [
                    'order_id' => $order->id,
                    'goods_id' => $menu->menu_id,//商品id
                    'goods_name' => $menu->menus->goods_name,//商品名称
                    'goods_img' => $menu->menus->goods_img,//商品图片
                    'amount' => $menu->nums,//商品数量
                    'goods_price' => $menu->menus->goods_price,//商品单价
                ];
                //判断商品数量是否满足库存
                $goods = Menu::where('id', $menu->menu_id)->first();
                if ($menu->nums > $goods->stock) {
                    //抛出异常
                    throw new Exception($menu->menus->goods_name . '库存不足');
                }
                //减掉库存
                $goods->stock = $goods->stock - $menu->nums;
                $goods->save();


                //插入订单物品表 order_details
                OrderDetail::create($values);

            }
            //清空购物车
            Cart::where('user_id', $user_id)->delete();


        } catch (Exception $exception) {
            //回滚事务
            DB::rollBack();
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }

        //下单完成发送邮件给商家
        //通过店铺id找到用户
        $shop=Shop::findOrFail($data['shop_id']);
        $user = User::findOrFail($shop->user_id);
        $content = '恭喜下单成功';
        $to = $user->email;//发邮件个用户
        $subject = '下单完成';
        Mail::send(
            'admin.email.xiadan',
            compact("content"),
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            });

        //邮件发送完成

        //下单完成，给会员发短信

        //调用短信发送
        $config = [
            'access_key' => 'LTAI2zMh1fLKargo', //键
            'access_secret' => 'Quj1ODS5Kh33f9M57Yjxk2sN2yKKRB',//密匙
            'sign_name' => '个人学习技术交流',//阿里云签名
        ];
      //找到当前用户的电话
        $user = Member::findOrFail($user_id);
        $tel=$user->tel;
        $num = $user->username;

        $sms = new AliSms();
        //$response = $sms->sendSms($tel, 'SMS_150571381', ['name'=> $num], $config);
        //短信发送完成






        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id,
        ];
    }

    //订单
    public function order(Request $request)
    {

        //接受订单id
        $order_id = $request->get('id');
        //找到订单信息
        $order = Order::where('id', $order_id)->first();
        //取出时间参数
        //$data =strtotime($order->created_at);
        //$order['order_birth_time']=date('Y-m-d H:i:s',$data);
        $order['order_birth_time'] = (string)$order->created_at;//强制转换

        //为了和前端对接，订单状态应为"代支付"
        $order['order_status'] = $order->status;//用了获取器
        //找到对应的订单商品信息
        $values = OrderDetail::where('order_id', $order_id)->get();
        //拼接数据
        $order['goods_list'] = $values;
        return $order;
    }

    //订单列表
    public function orderList(Request $request)
    {
        //接受会员id
        $user_id = $request->get('user_id');

        //通过user_id找到订单信息
        $orders = Order::where('user_id', $user_id)->get();
        //循环遍历订单，拼接数据
        foreach ($orders as $k => $v) {
            //找到订单对应的商品信息
            $order_da = OrderDetail::where('order_id', $v->id)->get();
            $v->order_status = $v->status;//用了获取器
            $v->goods_list = $order_da;
        }



        return $orders;
    }

    //余额支付
    public function pay(Request $request)
    {
        //接受订单id
        $order_id = $request->post('id');

        //查找订单信息
        $order = Order::where('id', $order_id)->first();
        $member_id = $order->user_id;
        //价钱
        $money = $order->order_price;
        //查找会员
        $member = Member::where('id', $member_id)->first();
        //判断订单状态，如果不是0就不能支付
        if ($order->order_status !=0){
            return [
                "status" => "true",
                "message" => "已经完成支付"
            ];
        }

        //判断会员的余额与订单价钱的大小
        if ($member->money >= $money) {
            //开启事务
           DB::transaction(function () use ($member,$money,$order){

               $member->money = $member->money - $money;
               $member->save();
               //并把订单状态更改
               $order->order_status = 1;
               $order->save();

           });

            return [
                "status" => "true",
                "message" => "支付成功"
            ];

        } else {
            return [
                "status" => "false",
                "message" => "余额不足"
            ];

        }


    }


}

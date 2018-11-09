{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","订单详情")
@section("content")

    <a href="#" onclick="javascript:history.back(-1);" class="btn btn-info">返回</a>
    <table class="table table-bordered table-hover">
        <caption>商品信息</caption>

        <tr>
            <th>店铺名称:</th>
            <td>{{$order->shop_name}}</td>
        </tr>

        @foreach($order->orderDeta as $v)
        <tr>
            <th>商品名称:</th>
            <td>{{$v->goods_name}}</td>
        </tr>
            <tr>
                <th>商品数量:</th>
                <td>{{$v->amount}}</td>
            </tr>

            <tr>
                <th>商品图片:</th>
                <td><img src="{{$v->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80" ></td>
            </tr>
            <tr>
                <th>商品单价:</th>
                <td>{{$v->goods_price}}</td>
            </tr>
        @endforeach

    </table>

    <table class="table table-bordered table-hover">
        <caption>配送信息</caption>
        <tr>
            <th>收货地址:</th>
            <td>{{$order->province.$order->city.$order->county}}</td>
        </tr>

        <tr>
            <th>收货人:</th>
            <td>{{$order->name}}</td>
        </tr>

        <tr>
            <th>联系电话:</th>
            <td>{{$order->tel}}</td>
        </tr>
    </table>

    <table class="table table-bordered table-hover">
        <caption>订单信息</caption>

        <tr>
            <th>订单号:</th>
            <td>{{$order->order_code}}</td>

        </tr>

        <tr>
            <th>订单状态:</th>
            <td>{{$order->status}}</td>

        </tr>

        <tr>
            <th>下单时间:</th>
            <td>{{$order->created_at}}</td>

        </tr>

    </table>


    @endsection

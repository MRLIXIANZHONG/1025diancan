{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","订单列表")


@section("content")

    {{--<div class="row">--}}
    {{--<div class="col-md-8 pull-right">--}}
    {{--<form class="form-inline pull-right" method="get">--}}
    {{--<div class="form-group">--}}
    {{--<select name="cate_id" class="form-control">--}}
    {{--<option value="">请选择分类</option>--}}
    {{--@foreach($ordercates as $ordercate)--}}
    {{--<option value="{{$menucate->id}}" {{request()->get('cate_id')==$menucate->id ? 'selected' : null}}>{{$menucate->name}}</option>--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{request()->get('minPrice')}}">--}}
    {{--</div>--}}
    {{-----}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{request()->get('maxPrice')}}">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get('keyword')}}">--}}
    {{--</div>--}}
    {{--<button type="submit" class="btn btn-success">搜索</button>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}

    <table class="table">

        <tr>
            <td>id</td>
            <td>订单编号</td>
            <td>店铺名称</td>
            <td>店铺图片</td>
            <td>订单金额</td>
            <td>订单创建时间</td>
            <td>订单状态</td>
            <td>操作</td>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->order_code}}</td>
                <td>{{$order->shop_name}}</td>
                <td>
                    <img src="{{$order->shop_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">
                </td>
                <td>{{$order->order_price}}</td>
                <td>
                    {{$order->created_at}}

                </td>
                @switch($order->order_status)
                    @case(-1)
                    <td>
                        <a href="#" class="btn btn-default">已取消</a>
                    </td>
                    @break
                    @case(0)
                    <td>
                        <a href="#" class="btn btn-danger">待支付</a>
                    </td>
                    @break
                    @case(1)
                    <td>
                        <a href="{{route('shop.order.status',$order->id)}}" class="btn btn-warning">待发货</a>
                    </td>
                    @break
                    @case(2)
                    <td>
                        <a href="{{route('shop.order.status',$order->id)}}" class="btn btn-primary">待收货</a>
                    </td>
                    @break
                    @default
                    <td>
                        <a href="#" class="btn btn-success">已完成</a>
                    </td>

                @endswitch


                    <td>
                        <a href="{{route('shop.order.detail',$order->id)}}" class="btn btn-success">订单详情</a>


                        @if($order->order_status ==0)
                            <a href="{{route('shop.order.status',$order->id)}}" class="btn btn-info">取消订单</a>
                        @endif
                    </td>

            </tr>

        @endforeach

    </table>
    {{--分页--}}
    <div class="pull-right">
        {{$orders->links()}}
    </div>

@endsection

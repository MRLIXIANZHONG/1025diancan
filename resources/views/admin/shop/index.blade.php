{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","店铺列表")


@section("content")

<table class="table table-bordered table-hover">

    <tr>
        <td>id</td>
        <td>店铺分类ID</td>
        <td>店名</td>
        <td>店铺图片</td>
        <td>评分</td>
        <td>所属商家</td>
        {{--<td>起送金额</td>--}}
        {{--<td>配送费</td>--}}
        <td>店公告</td>
        <td>优惠信息</td>
        <td>操作</td>
    </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->shopcate->name}}</td>
            <td>{{$shop->shop_name}}</td>
            <td>

                <img src="{{$shop->shop_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">

            </td>
            <td>{{$shop->shop_rating}}</td>
            <td>{{$shop->user->name ? $shop->user->name : null}}</td>

            {{--<td>{{$shop->start_send}}</td>--}}
            {{--<td>{{$shop->send_cost}}</td>--}}
            <td>{{$shop->notice}}</td>
            <td>{{$shop->discount}}</td>

            <td>
                <a href="{{route('admin.shop.edit',$shop->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger">删除</a>
                @if(!$shop->status)
                <a href="{{route('admin.shop.status',$shop->id)}}" class="btn btn-warning">审核</a>
                @endif
                @if($shop->status ==-1)
                    <a href="{{route('admin.shop.quxiao',$shop->id)}}" class="btn btn-primary">取消禁用</a>
                @else
                    <a href="{{route('admin.shop.jingyong',$shop->id)}}" class="btn btn-danger">禁用</a>
                 @endif
            </td>

        </tr>
            @endforeach



</table>
{{--分页--}}
<div class="pull-right">
    {{$shops->links()}}
</div>

    @endsection

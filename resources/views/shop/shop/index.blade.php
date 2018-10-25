{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","店铺管理")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>店铺分类ID</td>
        <td>店名</td>
        <td>店铺图片</td>
        <td>评分</td>
        <td>起送金额</td>
        <td>配送费</td>
        <td>店公告</td>
        <td>优惠信息</td>
        <td>操作</td>
    </tr>
        @foreach($ones as $one)
        <tr>
            <td>{{$one->id}}</td>
            <td>{{$one->shopcate->name}}</td>
            <td>{{$one->shop_name}}</td>
            <td>
                <img src="/{{$one->shop_img}}" width="100">
            </td>
            <td>{{$one->shop_rating}}</td>
            <td>{{$one->start_send}}</td>
            <td>{{$one->send_cost}}</td>
            <td>{{$one->notice}}</td>
            <td>{{$one->discount}}</td>

            <td>
                <a href="{{route('shop.edit',$one->id)}}" class="btn btn-success">编辑</a>
            </td>

        </tr>

        @endforeach



</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$ones->links()}}--}}
</div>

    @endsection

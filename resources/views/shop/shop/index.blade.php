{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","管理员管理")


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

        <tr>
            <td>{{$one[0]->id}}</td>
            <td>{{$one[0]->shopcate->name}}</td>
            <td>{{$one[0]->shop_name}}</td>
            <td>
                <img src="/{{$one[0]->shop_img}}" width="100">
            </td>
            <td>{{$one[0]->shop_rating}}</td>
            <td>{{$one[0]->start_send}}</td>
            <td>{{$one[0]->send_cost}}</td>
            <td>{{$one[0]->notice}}</td>
            <td>{{$one[0]->discount}}</td>

            <td>
                <a href="{{route('shop.editone',$one[0]->id)}}" class="btn btn-success">编辑</a>
            </td>

        </tr>



</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$one[0]s->links()}}--}}
</div>

    @endsection

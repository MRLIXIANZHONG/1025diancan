{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","菜单统计")
@section("content")

    <a href="#" onclick="javascript:history.back(-1);" class="btn btn-info">返回</a>

    <table class="table table-bordered table-hover">
        <caption>总订单量</caption>

        <tr>
            <th>店铺名称:</th>
            <td>{{$shop_name}}</td>
        </tr>
        @foreach($sums as $sum)
        <tr>
            <th>菜名:</th>
            <td style="color: red">{{$sum->goods_name}}</td>
        </tr>
        <tr>
            <th>数量:</th>
            <td>{{$sum->count}}</td>
        </tr>
        @endforeach
    </table>


    @endsection

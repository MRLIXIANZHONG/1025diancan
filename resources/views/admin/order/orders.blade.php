{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","订单统计")
@section("content")

    <a href="#" onclick="javascript:history.back(-1);" class="btn btn-info">返回</a>

    <table class="table table-bordered table-hover">
        <caption>总订单量</caption>


        <tr>
            <th>总单量:</th>
            <td style="color: red">{{$sums->nums}}</td>
        </tr>
        <tr>
            <th>总收益:</th>
            <td>{{$sums->moneys}}</td>
        </tr>

    </table>


    @endsection

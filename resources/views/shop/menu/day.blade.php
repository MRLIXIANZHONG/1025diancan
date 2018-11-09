{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","订单统计")
@section("content")



    <a href="#" onclick="javascript:history.back(-1);" class="btn btn-info">返回</a>
    <div class="row">
    <div class="col-md-8 pull-right">
    <form class="form-inline pull-right" method="get">
    {{--<div class="form-group">--}}
    {{--<select name="cate_id" class="form-control">--}}
    {{--<option value="">请选择分类</option>--}}
    {{--@foreach($ordercates as $ordercate)--}}
    {{--<option value="{{$menucate->id}}" {{request()->get('cate_id')==$menucate->id ? 'selected' : null}}>{{$menucate->name}}</option>--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    <div class="form-group">
    <input type="date" class="form-control"  placeholder="选择日期" size="5" name="date" value="{{request()->get('date')}}">
    </div>
    {{-----}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{request()->get('maxPrice')}}">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get('keyword')}}">--}}
    {{--</div>--}}
    <button type="submit" class="btn btn-success">搜索</button>
    </form>
    </div>
    </div>

    <table class="table table-bordered table-hover">
        <caption>按天统计</caption>


        <tr>
            <th>店铺名称:</th>
            <td>{{$shop_name}}</td>
        </tr>
        @foreach($days as $day)
        <tr>
            <th>日期:</th>
            <td style="color: red">{{strstr($day->created_at," ",true)}}</td>
        </tr>
        <tr>
            <th>菜品名称:</th>
            <td>{{$day->goods_name}}</td>
        </tr>
            <tr>
                <th>数量:</th>
                <td>{{$day->count}}</td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    <div class="pull-right">
        {{--{{$days->links()}}--}}
        {{$days->appends($url)->render()}}
    </div>

    @endsection

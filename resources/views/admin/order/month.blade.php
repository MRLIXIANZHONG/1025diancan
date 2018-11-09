{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","订单统计")
@section("content")

    <a href="#" onclick="javascript:history.back(-1);" class="btn btn-info">返回</a>
    <div class="row">
        <div class="col-md-8 pull-right">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                <select name="user_id" class="form-control">
                <option value="">请选择商家</option>
                @foreach($users as $user)
                <option value="{{$user->id}}" {{request()->get('user_id')==$user->id ? 'selected' : null}}>{{$user->name}}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                    <input type="month" class="form-control"  placeholder="选择日期" size="5" name="date" value="{{request()->get('date')}}">
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
        <caption>按月统计</caption>
        {{--@if(isset($shop_name))--}}
        {{--<tr>--}}
            {{--<th>店铺名称:</th>--}}
            {{--<td>{{$shop_name}}</td>--}}
        {{--</tr>--}}
        {{--@endif--}}
        {{--@foreach($days as $day)--}}
        {{--<tr>--}}
            {{--<th>日期:</th>--}}
            {{--<td style="color: red">{{$day->date}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<th>月订单量:</th>--}}
            {{--<td>{{$day->nums}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<th>收益:</th>--}}
            {{--<td>{{$day->moneys}}</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}


            <tr>

                <th>日期</th>
                <th>订单编号</th>
                <th>订单数量</th>
                <th>收益</th>
            </tr>
            @foreach($months as $month)
            <tr>

                <td>{{$month->date}}</td>
                <td>{{$month->order_code}}</td>
                <td>{{$month->nums}}</td>
                <td>{{$month->moneys}}</td>

            </tr>
            @endforeach
        </table>


    {{--分页--}}
    <div class="pull-right">
        {{--{{$days->links()}}--}}
        {{$months->appends($url)->render()}}
    </div>

    @endsection

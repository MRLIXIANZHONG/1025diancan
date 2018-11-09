{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","菜品统计")
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
       <tr>
           <th>时间</th>
           <th>商品</th>
           <th>数量</th>
       </tr>

        @foreach($months as $month)
        <tr>
            <th>{{$month->date}}</th>
            <th>{{$month->goods_name}}</th>
            <th>{{$month->nums}}</th>
        </tr>
        @endforeach
    </table>
    {{--分页--}}
    <div class="pull-right">
        {{--{{$months->links()}}--}}
        {{$months->appends($url)->render()}}
    </div>

    @endsection

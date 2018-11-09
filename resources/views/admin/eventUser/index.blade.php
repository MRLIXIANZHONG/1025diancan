{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","报名列表")


@section("content")

    <a href="{{route('admin.event.index')}}" class="btn btn-info">返回</a>
   {{--<div class="col-md-8 pull-right">--}}
       {{--<div class="form-group">--}}
           {{--<form class="form-inline pull-right" method="get">--}}
           {{--<select name="cate_id" class="form-control">--}}
               {{--<option value="">筛选活动</option>--}}
               {{--<option value="1" {{request()->get('cate_id')==1 ? 'selected' : null}}>未开始</option>--}}
               {{--<option value="2" {{request()->get('cate_id')==2 ? 'selected' : null}}>进行中</option>--}}
               {{--<option value="3" {{request()->get('cate_id')==3 ? 'selected' : null}}>已结束</option>--}}
           {{--</select>--}}
               {{--<button type="submit" class="btn btn-success">搜索</button>--}}
           {{--</form>--}}
       {{--</div>--}}

   {{--</div>--}}




    <table class="table">

    <tr>
        <td>id</td>
        <td>活动</td>
        <td>报名会员</td>
    </tr>

        @foreach($eventUsers as $eventUser)
        <tr>
            <td>{{$eventUser->id}}</td>
            <td>{{$eventUser->event->title}}</td>
            <td>{{$eventUser->user->name}}</td>

        </tr>
        @endforeach
    {{--@foreach($events as $event)--}}
        {{--<tr>--}}
            {{--<td>{{$event->id}}</td>--}}
            {{--<td>{{$event->title}}</td>--}}
            {{--<td>{!! $event->content !!}</td>--}}
            {{--<td>{{date('Y-m-d H:i:s',$event->start_time)}}</td>--}}
            {{--<td>{{date('Y-m-d H:i:s',$event->end_time)}}</td>--}}
            {{--<td>{{date('Y-m-d H:i:s',$event->prize_time)}}</td>--}}
            {{--<td>--}}
                {{--<a href="{{route('admin.eventPrize.index',$event->id)}}" class="btn btn-success">奖品详情</a>--}}
                {{--<a href="{{route('admin.eventPrize.add',$event->id)}}" class="btn btn-info">添加奖品</a>--}}
                {{--<a href="{{route('admin.event.edit',$event->id)}}" class="btn btn-success">编辑</a>--}}
                {{--<a href="{{route('admin.event.del',$event->id)}}" class="btn btn-danger">删除</a>--}}
                {{--@if($event->is_prize ==0)--}}
                {{--<a href="{{route('admin.event.on',$event->id)}}" class="btn btn-warning">开奖</a>--}}
                {{--@endif--}}

            {{--</td>--}}

        {{--</tr>--}}

    {{--@endforeach--}}

</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$events->appends($url)->render()}}--}}
    {{$eventUsers->links()}}
</div>

    @endsection

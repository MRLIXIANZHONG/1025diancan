{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","奖品列表")


@section("content")
    <a href="{{route('admin.event.index')}}" class="btn btn-info">返回</a>
<table class="table">

    <tr>
        <td>id</td>
        <td>奖品名称</td>
        <td>奖品详情</td>
        <td>活动</td>
        <td>中奖用户</td>
        <td>操作</td>
    </tr>
    @foreach($eventPrizes as $eventPrize)
        <tr>
            <td>{{$eventPrize->id}}</td>
            <td>{{$eventPrize->name}}</td>
            <td>{{$eventPrize->description}}</td>
            <td>{{$eventPrize->event->title}}</td>
            <td>{{$eventPrize->user_id ? $eventPrize->user->name : null}}</td>

            <td>
                <a href="{{route('admin.eventPrize.edit',$eventPrize->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.eventPrize.del',$eventPrize->id)}}" class="btn btn-danger">删除</a>

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$eventPrizes->links()}}
</div>

    @endsection

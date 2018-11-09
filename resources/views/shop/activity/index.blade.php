{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","活动列表")


@section("content")


    <table class="table">

    <tr>
        <td>id</td>
        <td>标题</td>
        <td>内容</td>
        <td>开始时间</td>
        <td>结束时间</td>

    </tr>
    @foreach($activitys as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td>{!! $activity->content !!}</td>
            <td>{{date('Y-m-d H:i:s',$activity->start_time)}}</td>
            <td>{{date('Y-m-d H:i:s',$activity->end_time)}}</td>



        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$activitys->links()}}
</div>

    @endsection

@extends("layouts.admin.main")
@section("title","编辑活动")
@section("content")
    {{--引入互文本编辑器--}}
    @include('vendor.ueditor.assets')


    <form  method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">活动标题</label>
                <input type="text" class="form-control" name="title" value="{{$activity->title}}" >
            </div>

            <div class="form-group">
                <label for="content">活动内容</label>
                <script id="container" name="content" type="text/plain">{!! $activity->content !!}</script>
            </div>

            <div class="form-group">
                <label for="start_time">活动开始时间</label>
                <input type="datetime-local" class="form-control" name="start_time" value="{{$activity->start_time}}" >
            </div>

            <div class="form-group">
                <label for="end_time">活动结束时间</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{$activity->end_time}}" >
            </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>

    @endsection

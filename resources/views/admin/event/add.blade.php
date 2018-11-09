@extends("layouts.admin.main")
@section("title","添加抽奖活动")
@section("content")
    {{--引入互文本编辑器--}}
    @include('vendor.ueditor.assets')


    <form  method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">活动标题</label>
                <input type="text" class="form-control" name="title" placeholder="活动标题" >
            </div>

            <div class="form-group">
                <label for="content">活动内容</label>
                <script id="container" name="content" type="text/plain"></script>
            </div>

            <div class="form-group">
                <label for="start_time">报名开始时间</label>
                <input type="date" class="form-control" name="start_time" >
            </div>

            <div class="form-group">
                <label for="end_time">报名结束时间</label>
                <input type="date" class="form-control" id="end_time" name="end_time" >
            </div>

        <div class="form-group">
            <label for="end_time">开奖时间</label>
            <input type="date" class="form-control" id="end_time" name="prize_time" >
        </div>

        <div class="form-group">
            <label for="end_time">报名人数限制</label>
            <input type="text" class="form-control" id="end_time" name="num" >
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>

    @endsection

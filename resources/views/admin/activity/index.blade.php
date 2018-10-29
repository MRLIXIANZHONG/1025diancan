{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","管理活动")


@section("content")
   <div class="col-md-8 pull-right">
       <div class="form-group">
           <form class="form-inline pull-right" method="get">
           <select name="cate_id" class="form-control">
               <option value="">筛选活动</option>
               <option value="1" {{request()->get('cate_id')==1 ? 'selected' : null}}>未开始</option>
               <option value="2" {{request()->get('cate_id')==2 ? 'selected' : null}}>进行中</option>
               <option value="3" {{request()->get('cate_id')==3 ? 'selected' : null}}>已结束</option>
           </select>
               <button type="submit" class="btn btn-success">搜索</button>
           </form>
       </div>

   </div>




    <table class="table">

    <tr>
        <td>id</td>
        <td>标题</td>
        <td>内容</td>
        <td>开始时间</td>
        <td>结束时间</td>
        <td>操作</td>
    </tr>
    @foreach($activitys as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td>{!! $activity->content !!}</td>
            <td>{{date('Y-m-d H:i:s',$activity->start_time)}}</td>
            <td>{{date('Y-m-d H:i:s',$activity->end_time)}}</td>
            <td>

                <a href="{{route('admin.activity.edit',$activity->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.activity.del',$activity->id)}}" class="btn btn-danger">删除</a>


            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$activitys->appends($url)->render()}}
</div>

    @endsection

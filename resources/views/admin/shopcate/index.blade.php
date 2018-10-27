{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","分类列表")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>类名</td>
        <td>图片</td>
        <td>状态</td>


        <td>操作</td>
    </tr>
    @foreach($shopcates as $shopcate)
        <tr>
            <td>{{$shopcate->id}}</td>
            <td>{{$shopcate->name}}</td>
            <td>
                <img src="/{{$shopcate->img}}" width="100">
            </td>
            <td>{{$shopcate->status ? '上线' : '下线'}}</td>


            <td>
                <a href="{{route('shopcate.edit',$shopcate->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('shopcate.del',$shopcate->id)}}" class="btn btn-danger">删除</a>
                @if($shopcate->status)
                    <a href="{{route('shopcate.xia',$shopcate->id)}}" class="btn btn-warning">下线</a>
                @else
                    <a href="{{route('shopcate.shang',$shopcate->id)}}" class="btn btn-primary">上线</a>
                 @endif

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$shopcates->links()}}--}}
</div>

    @endsection

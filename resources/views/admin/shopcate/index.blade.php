{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","管理员管理")


@section("content")
<a href="{{route('shopcate.add')}}" class="btn btn-info">添加</a>
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

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{--{{$shopcates->links()}}--}}
</div>

    @endsection

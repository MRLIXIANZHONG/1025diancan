{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","权限列表")


@section("content")
<a href="{{route('admin.permission.add')}}" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <td>id</td>
        <td>路由</td>
        <td>备注</td>
        <td>操作</td>
    </tr>
    @foreach($pers as $per)
        <tr>
            <td>{{$per->id}}</td>
            <td>{{$per->name}}</td>
            <td>{{$per->intro}}</td>
            <td>
                <a href="{{route('admin.permission.edit',$per->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.permission.del',$per->id)}}" class="btn btn-danger">删除</a>


            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$pers->links()}}
</div>

    @endsection

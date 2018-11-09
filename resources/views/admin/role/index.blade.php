{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","角色列表")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>角色名</td>
        <td>保安</td>
        <td>操作</td>
    </tr>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->guard_name}}</td>

            <td>
                <a href="{{route('admin.role.edit',$role->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.role.ones',$role->id)}}" class="btn btn-success">详情</a>
                <a href="{{route('admin.role.del',$role->id)}}" class="btn btn-danger">删除</a>


            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$roles->links()}}
</div>

    @endsection

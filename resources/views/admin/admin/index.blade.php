{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","管理员管理")


@section("content")
<a href="{{route('admin.add')}}" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <td>id</td>
        <td>用户</td>
        <td>邮箱</td>
        <td>操作</td>
    </tr>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>
                <a href="{{route('admin.password',$admin->id)}}" class="btn btn-success">重置密码</a>
                <a href="{{route('admin.edit',$admin->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.del',$admin->id)}}" class="btn btn-danger">删除</a>


            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$admins->links()}}
</div>

    @endsection

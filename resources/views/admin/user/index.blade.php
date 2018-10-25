{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","商家管理")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>用户</td>
        <td>头像</td>
        <td>email</td>
        <td>tel</td>

        <td>操作</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>
                <img src="/{{$user->photo}}" width="100">
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->tel}}</td>

            <td>
                <a href="{{route('admin.user.password',$user->id)}}" class="btn btn-success">重置密码</a>
                <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('admin.user.del',$user->id)}}" class="btn btn-danger">删除</a>

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$users->links()}}
</div>

    @endsection

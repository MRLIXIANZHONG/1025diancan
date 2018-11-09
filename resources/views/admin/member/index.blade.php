{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","商家管理")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>用户</td>
        <td>tel</td>
        <td>余额</td>
        <td>积分</td>
        <td>操作</td>
    </tr>
    @foreach($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->username}}</td>
            <td>{{$member->tel}}</td>
            <td>{{$member->money}}</td>
            <td>{{$member->jifen}}</td>

            <td>
                <a href="#" class="btn btn-success">重置密码</a>

            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$members->links()}}
</div>

    @endsection

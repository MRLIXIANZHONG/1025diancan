{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","角色列表详情")


@section("content")
<a onclick="javascript:history.back(-1)" class="btn btn-info">返回</a>
<table class="table">

   <tr>
       <td>id</td>
       <td>{{$role->id}}</td>
   </tr>

    <tr>
        <td>角色名</td>
        <td>{{$role->name}}</td>
    </tr>
</table>

    <table class="table">
        <caption>权限</caption>
        @foreach($pers as $per)
        <tr>
            <td>{{$per}}</td>

        </tr>
        @endforeach

    </table>

{{--分页--}}
<div class="pull-right">

</div>

    @endsection

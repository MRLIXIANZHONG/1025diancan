@extends("layouts.admin.main")
@section("title","权限编辑")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>路由:</td>
            <td><input type="text" name="name" class="form-control" value="{{$per->name}}"></td>
        </tr>

            <tr>
                <td>备注:</td>
                <td><input type="text" name="intro" class="form-control" value="{{$per->intro}}"></td>
            </tr>


        <tr>
            <td colspan="2">
                <input type="submit" value="编辑" class="btn btn-info">
                {{--<a href="#" class=" btn btn-info pull-right">已有账号</a>--}}
            </td>
        </tr>

        </form>
    </table>


    @endsection

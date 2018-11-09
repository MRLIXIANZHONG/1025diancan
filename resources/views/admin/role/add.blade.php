@extends("layouts.admin.main")
@section("title","添加角色")
@section("content")

    <a href="" class="btn btn-info">返回</a>
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>角色:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            <tr>
                <td>权限:</td>
                <td>
                    @foreach($pers as $per)
                    <input type="checkbox" name="per[]" class="" value="{{$per['id']}}">{{$per['intro']}}
                    @endforeach
                </td>
            </tr>

        <tr>
            <td colspan="2">
                <input type="submit" value="添加" class="btn btn-info">
                {{--<a href="#" class=" btn btn-info pull-right">已有账号</a>--}}
            </td>
        </tr>

        </form>
    </table>


    @endsection

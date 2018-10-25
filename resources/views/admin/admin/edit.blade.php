{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","编辑管理员")
@section("content")
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{--<input type="hidden" name="id" value="{{$categorys->id}}">--}}
        <tr>
            <td>姓名:</td>

            <td><input type="text" name="name" class="form-control" value="{{$admin->name}}">
            </td>
        </tr>

            <tr>
                <td>更改密码:</td>

                <td><input type="text" name="password" class="form-control">
                </td>
            </tr>
            <tr>
                <td>确认密码:</td>

                <td><input type="text" name="password_confirmation" class="form-control" >
                </td>
            </tr>

            <tr>
                <td>头像:</td>
                <td>
                    <input type="file" name="photo" class="form-group-sm" >
                    <img src="/{{$admin->photo}}" width="100">
                    <input type="hidden" name="oldp" value="{{$admin->photo}}">
                </td>
            </tr>



        <tr>
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

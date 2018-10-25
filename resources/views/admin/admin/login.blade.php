{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","管理员登录")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>用户名:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            <tr>
                <td>密码:</td>
                <td><input type="password" name="password" class="form-control" ></td>
            </tr>

            <tr>
                <td>记住我:</td>
                <td><input type="checkbox" name="remember"></td>
            </tr>



        <tr>
            <td colspan="2">
                <input type="submit" value="登录" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

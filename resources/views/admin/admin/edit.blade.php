@extends("layouts.admin.main")
@section("title","管理员编辑")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>姓名:</td>
            <td><input type="text" name="name" class="form-control" value="{{$admin->name}}"></td>
        </tr>

            <tr>
                <td>email:</td>
                <td><input type="email" name="email" class="form-control" value="{{$admin->email}}"></td>
            </tr>


            <tr>
                <td>密码:</td>
                <td><input type="password" name="password" class="form-control" ></td>
            </tr>

            <tr>
                <td>确认密码:</td>
                <td><input type="password" name="password_confirmation" class="form-control"></td>
            </tr>

            {{--<tr>--}}
                {{--<td>头像:</td>--}}
                {{--<td><input type="file" name="photo" class="form-group-sm" ></td>--}}
            {{--</tr>--}}

            {{--<tr>--}}
                {{--<td>验证码:</td>--}}

                {{--<td>--}}
                    {{--<input id="captcha" class="form-group-sm" name="captcha" >--}}
                    {{--<img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}

                {{--</td>--}}
            {{--</tr>--}}


        <tr>
            <td colspan="2">
                <input type="submit" value="编辑" class="btn btn-info">
                {{--<a href="#" class=" btn btn-info pull-right">已有账号</a>--}}
            </td>
        </tr>

        </form>
    </table>


    @endsection

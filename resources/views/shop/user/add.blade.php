@extends("layouts.shop.login")
@section("title","注册")
@section("form")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>姓名:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            <tr>
                <td>email:</td>
                <td><input type="email" name="email" class="form-control" value="{{old('email')}}"></td>
            </tr>

            <tr>
                <td>电话:</td>
                <td><input type="text" name="tel" class="form-control" value="{{old('tel')}}"></td>
            </tr>

            <tr>
                <td>密码:</td>
                <td><input type="password" name="password" class="form-control" ></td>
            </tr>

            <tr>
                <td>确认密码:</td>
                <td><input type="password" name="password_confirmation" class="form-control"></td>
            </tr>

            <tr>
                <td>头像:</td>
                <td>
                    <div class="form-group">
                        <label>图像</label>

                        <input type="hidden" name="photo" id="shop_img">
                        <!--dom结构部分-->
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>

                    </div>
                </td>
            </tr>


            <tr>
                <td>验证码:</td>

                <td>
                    <input id="captcha" class="form-group-sm" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

                </td>
            </tr>


        <tr>
            <td colspan="2">
                <input type="submit" value="注册" class="btn btn-info">
                <a href="{{route("user.login")}}" class=" btn btn-info pull-right">已有账号</a>
            </td>
        </tr>

        </form>
    </table>


    @endsection

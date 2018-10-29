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

            <td><input type="text" name="name" class="form-control" value="{{$user->name}}">
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
                <td>电话:</td>

                <td><input type="text" name="tel" class="form-control" value="{{$user->tel}}">
                </td>
            </tr>
            <tr>
                <td>邮箱:</td>

                <td><input type="text" name="email" class="form-control" value="{{$user->email}}">
                </td>
            </tr>

            <tr>
                <td>头像:</td>

                <td>
                    <img src="{{$user->photo}}?x-oss-process=image/resize,m_fill,w_80,h_80" >
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
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

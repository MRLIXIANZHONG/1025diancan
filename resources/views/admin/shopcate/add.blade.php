{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","添加分类")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>分类名:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            <tr>
                <td>分类图片:</td>

                <td>
                    <div class="form-group">
                        <label>图像</label>

                        <input type="hidden" name="img" value="" id="shop_img">
                        <!--dom结构部分-->
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>

                    </div>
                </td>
            <tr>


            <tr>
                <td>状态:</td>
                <td>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status"  value="1" checked>
                            上线
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0">
                            下线
                        </label>
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

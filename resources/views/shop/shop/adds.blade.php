{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","添加管理员")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>店铺名称:</td>
            <td><input type="text" name="shop_name" class="form-control" value="{{old('shop_name')}}"></td>
        </tr>

            <tr>
                <td>店铺分类:</td>
                <td>
                    <select name="shop_category_id" class="form-control" >
                        @foreach($shopcates as $shopcate)
                        <option value="{{$shopcate->id}}">{{$shopcate->name}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <td>所属商家:</td>
                <td>
                    <select name="user_id" class="form-control" >
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <td>起送金额:</td>
                <td><input type="text" name="start_send" class="form-control" value="{{old('start_send')}}"></td>
            </tr>

            <tr>
                <td>店铺图片:</td>

                <td>
                    <div class="form-group">
                        <label>图像</label>

                        <input type="hidden" name="shop_img" value="" id="shop_img">
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
                <td>配送费:</td>
                <td><input type="text" name="send_cost" class="form-control" value="{{old('send_cost')}}"></td>
            </tr>

            <tr>
                <td>店公共:</td>
                <td><input type="text" name="notice" class="form-control" value="{{old('notice')}}"></td>
            </tr>

            <tr>
                <td>优惠信息:</td>
                <td><input type="text" name="discount" class="form-control" value="{{old('discount')}}"></td>
            </tr>

            <tr>
                <td></td>
                <td>

                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="brand"> 品牌连锁
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="on_time"> 准时送达
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="fengniao"> 蜂鸟配送
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="bao"> 保
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="piao"> 票
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="zhun"> 准
                    </label>

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
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","编辑菜品")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>菜品名称:</td>
            <td><input type="text" name="goods_name" class="form-control" value="{{$menu->goods_name}}"></td>
        </tr>

            <tr>
                <td>菜品分类:</td>
                <td>
                    <select name="category_id" class="form-control" >
                        @foreach($menucates as $menucate)
                        <option value="{{$menucate->id}}" {{$menucate->id == $menu->category_id ? 'selected' : null}}>{{$menucate->name}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            {{--<tr>--}}
                {{--<td>所属商家:</td>--}}
                {{--<td>--}}
                    {{--<select name="user_id" class="form-control" >--}}
                        {{--@foreach($users as $user)--}}
                            {{--<option value="{{$user->id}}">{{$user->name}}</option>--}}
                        {{--@endforeach--}}

                    {{--</select>--}}
                {{--</td>--}}
            {{--</tr>--}}

            <tr>
                <td>价格:</td>
                <td><input type="text" name="goods_price" class="form-control" value="{{$menu->goods_price}}"></td>
            </tr>

            <tr>
                <td>描述:</td>
                <td><textarea name="description" id="" cols="30" rows="10" class="form-control">{{$menu->description}}</textarea></td>
            </tr>

            <tr>
                <td>提示信息:</td>
                <td><input type="text" name="tips" class="form-control" value="{{$menu->tips}}"></td>
            </tr>

            <tr>
                <td>商品图片:</td>

                <td>
                    <img src="{{$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80" >
                    <div class="form-group">
                        <label>图像</label>

                        <input type="hidden" name="goods_img" id="shop_img">
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
                <td>状态:</td>
            <td>
                <div class="radio">
                <label>
                <input type="radio" name="status"  value="1" {{$menu->status ? "checked" : null}}>
                上线
                </label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" name="status" value="0" {{$menu->status ? null : 'checked'}}>
                下线
                </label>
                </div>
            </td>
            </tr>


            {{--<tr>--}}
                {{--<td>验证码:</td>--}}

                {{--<td>--}}
                    {{--<input id="captcha" class="form-group-sm" name="captcha" >--}}
                    {{--<img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}

                {{--</td>--}}
            {{--</tr>--}}


        <tr>
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

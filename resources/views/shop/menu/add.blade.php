{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","添加菜品")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>菜品名称:</td>
            <td><input type="text" name="goods_name" class="form-control" value="{{old('goods_name')}}"></td>
        </tr>

            <tr>
                <td>菜品分类:</td>
                <td>
                    <select name="category_id" class="form-control" >
                        @foreach($menucates as $menucate)
                        <option value="{{$menucate->id}}">{{$menucate->name}}</option>
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
                <td><input type="text" name="goods_price" class="form-control" value="{{old('goods_price')}}"></td>
            </tr>

            <tr>
                <td>描述:</td>
                <td><textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description')}}</textarea></td>
            </tr>

            <tr>
                <td>提示信息:</td>
                <td><input type="text" name="tips" class="form-control" value="{{old('tips')}}"></td>
            </tr>

            <tr>
                <td>商品图片:</td>
                <td><input type="file" name="goods_img"></td>
            </tr>

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

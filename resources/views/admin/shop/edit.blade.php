{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","编辑店铺")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>店铺名称:</td>
            <td><input type="text" name="shop_name" class="form-control" value="{{$shop->shop_name}}"></td>
        </tr>

            <tr>
                <td>店铺分类:</td>
                <td>
                    <select name="shop_category_id" class="form-control" >
                        @foreach($shopcates as $shopcate)
                        <option value="{{$shopcate->id}}" {{$shop->shop_name == $shopcate->id ? 'selected' : null}}>{{$shopcate->name}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <td>所属商家:</td>
                <td>
                    <select name="user_id" class="form-control" >
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{$shop->user_id == $user->id ? 'selected' : null}}>{{$user->name}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <td>起送金额:</td>
                <td><input type="text" name="start_send" class="form-control" value="{{$shop->start_send}}"></td>
            </tr>

            <tr>
                <td>店铺图片:</td>
                <td>
                    <input type="file" name="shop_img" class="form-control" >
                    <img src="/{{$shop->shop_img}}" width="100">
                    <input type="hidden" name="oldp" value="{{$shop->shop_img}}">
                </td>
            </tr>

            <tr>
                <td>配送费:</td>
                <td><input type="text" name="send_cost" class="form-control" value="{{$shop->send_cost}}"></td>
            </tr>

            <tr>
                <td>店公告:</td>
                <td><input type="text" name="notice" class="form-control" value="{{$shop->notice}}"></td>
            </tr>

            <tr>
                <td>优惠信息:</td>
                <td><input type="text" name="discount" class="form-control" value="{{$shop->discount}}"></td>
            </tr>

            <tr>
                <td></td>
                <td>

                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="brand" {{$shop->brand ? 'checked' : null}}> 品牌连锁
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="on_time" {{$shop->on_time ? 'checked' : null}}> 准时送达
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="fengniao" {{$shop->fengniao ? 'checked' : null}}> 蜂鸟配送
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="bao" {{$shop->bao ? 'checked' : null}}> 保
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="piao" {{$shop->piao ? 'checked' : null}}> 票
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox"  value="1" name="zhun" {{$shop->zhun ? 'checked' : null}}> 准
                    </label>

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

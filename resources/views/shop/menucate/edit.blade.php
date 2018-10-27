{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","编辑菜品分类")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>名称:</td>
            <td><input type="text" name="name" class="form-control" value="{{$menucate->name}}"></td>
        </tr>

            <tr>
                <td>菜品编号:</td>
                <td><input type="text" name="type_accumulation" placeholder="请输入a-z编号" class="form-control" value="{{$menucate->type_accumulation}}"></td>
            </tr>

            <tr>
                <td>描述:</td>
                <td>
                    <textarea name="description" id="" cols="160" rows="10" class="form-control">{{$menucate->description}}</textarea>
                </td>
            </tr>

            {{--<tr>--}}
                {{--<td>状态:</td>--}}
                {{--<td>--}}
                    {{--<div class="radio">--}}
                        {{--<label>--}}
                            {{--<input type="radio" name="status"  value="1" checked>--}}
                            {{--上线--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                        {{--<label>--}}
                            {{--<input type="radio" name="status" value="0">--}}
                            {{--下线--}}
                        {{--</label>--}}
                    {{--</div>--}}
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

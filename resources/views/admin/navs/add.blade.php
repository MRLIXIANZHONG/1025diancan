@extends("layouts.admin.main")
@section("title","添加管理员")
@section("content")

    <a href="{{route('admin.navs.index')}}" class="btn btn-info">返回</a>
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>名称:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            <tr>
                <td>路由:</td>
                <td>
                    <select name="url" class="form-control">
                        <option value="0">请选择路由/不选为顶级菜单</option>
                        @foreach($urls as $url)
                        <option value="{{$url}}">{{$url}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>


            <tr>
                <td>上级id:</td>
                <td><input type="text" name="pid" class="form-control" value=0></td>
            </tr>



        <tr>
            <td colspan="2">
                <input type="submit" value="添加" class="btn btn-info">
                {{--<a href="#" class=" btn btn-info pull-right">已有账号</a>--}}
            </td>
        </tr>

        </form>
    </table>


    @endsection

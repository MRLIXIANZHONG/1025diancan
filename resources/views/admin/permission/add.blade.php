@extends("layouts.admin.main")
@section("title","添加权限")
@section("content")

    <a href="{{route('admin.permission.index')}}" class="btn btn-info">返回</a>
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <tr>
                <td>权限:</td>
                <td>
                    <select name="name" class="form-control">
                        @foreach($urls as $url)
                            <option value="{{$url}}">{{$url}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td>备注:</td>
                <td><input type="text" name="intro" class="form-control" value="{{old('intro')}}"></td>
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

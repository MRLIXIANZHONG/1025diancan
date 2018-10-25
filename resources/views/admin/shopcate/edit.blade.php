{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","编辑分类")
@section("content")
    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{--<input type="hidden" name="id" value="{{$categorys->id}}">--}}
        <tr>
            <td>类名:</td>

            <td><input type="text" name="name" class="form-control" value="{{$shopcate->name}}">
            </td>
        </tr>

            <tr>
                <td>状态:</td>
                <td>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status"  value="1" {{$shopcate->status ? 'checked' : null}}>
                            上线
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0" {{$shopcate->status ? null : 'checked'}}>
                            下线
                        </label>
                    </div>
                </td>
            </tr>


            <tr>
                <td>头像:</td>
                <td>
                    <input type="file" name="img" class="form-group-sm" >
                    <img src="/{{$shopcate->img}}" width="100">
                    <input type="hidden" name="oldp" value="{{$shopcate->img}}">
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

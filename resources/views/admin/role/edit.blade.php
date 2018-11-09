@extends("layouts.admin.main")
@section("title","角色编辑")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>角色名:</td>
            <td><input type="text" name="name" class="form-control" value="{{$role->name}}"></td>
        </tr>

            <tr>
                <td>权限:</td>
                <td>
                    @foreach($pers as $per)
                    <input type="checkbox" name="per[]" value="{{$per->id}}" {{in_array($per->id,$cper->toarrAy()) ? 'checked' : null}}>{{$per->intro}}
                    @endforeach
                </td>
            </tr>


        <tr>
            <td colspan="2">
                <input type="submit" value="编辑" class="btn btn-info">
                {{--<a href="#" class=" btn btn-info pull-right">已有账号</a>--}}
            </td>
        </tr>

        </form>
    </table>


    @endsection

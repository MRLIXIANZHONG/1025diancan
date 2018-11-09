{{--继承主模块--}}
@extends("layouts.admin.main")
{{--添加标记--}}
@section("title","添加奖品")
@section("content")

    <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <tr>
            <td>奖品名称:</td>
            <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
        </tr>

            {{--<tr>--}}
                {{--<td>活动名称:</td>--}}
                {{--<td>--}}
                    {{--<select name="event_id" class="form-control" >--}}
                        {{--@foreach($events as $event)--}}
                        {{--<option value="{{$event->id}}">{{$event->title}}</option>--}}
                        {{--@endforeach--}}

                    {{--</select>--}}
                {{--</td>--}}
            {{--</tr>--}}

            <tr>
                <td>奖品详情:</td>
                <td><input type="text" name="description" class="form-control" value="{{old('description')}}"></td>
            </tr>


        <tr>
            <td colspan="2">
                <input type="submit" value="提交" class="btn btn-info">
            </td>
        </tr>

        </form>
    </table>


    @endsection

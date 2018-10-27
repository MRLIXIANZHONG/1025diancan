{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","分类列表")


@section("content")

<table class="table">

    <tr>
        <td>id</td>
        <td>名称</td>
        <td>编号</td>
        <td>所属商家</td>
        <td>是否默认菜单</td>
        <td>操作</td>
    </tr>
    @foreach($menucates as $menucate)
        <tr>
            <td>{{$menucate->id}}</td>
            <td>{{$menucate->name}}</td>
            <td>{{$menucate->type_accumulation}}</td>
            <td>
                {{$menucate->shop->shop_name}}
            </td>
            <td>{{$menucate->is_selected ? '是' : '不'}}</td>


            <td>
                <a href="{{route('menucate.edit',$menucate->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('menucate.del',$menucate->id)}}" class="btn btn-danger">删除</a>
                @if(!$menucate->is_selected)
                <a href="{{route('menucate.moren',$menucate->id)}}" class="btn btn-warning">设为默认菜单</a>
                @endif
            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$menucates->links()}}
</div>

    @endsection

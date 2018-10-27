{{--继承主模块--}}
@extends("layouts.shop.main")
{{--添加标记--}}
@section("title","分类列表")


@section("content")

    <div class="row">
        <div class="col-md-8 pull-right">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="cate_id" class="form-control">
                        <option value="">请选择分类</option>
                        @foreach($menucates as $menucate)
                            <option value="{{$menucate->id}}" {{request()->get('cate_id')==$menucate->id ? 'selected' : null}}>{{$menucate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{request()->get('minPrice')}}">
                </div>
                -
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{request()->get('maxPrice')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get('keyword')}}">
                </div>
                <button type="submit" class="btn btn-success">搜索</button>
            </form>
        </div>
    </div>

<table class="table">

    <tr>
        <td>id</td>
        <td>名称</td>
        <td>所属分类</td>
        <td>价格</td>
        <td>状态</td>        
        <td>图片</td>
        <td>操作</td>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->menucate->name}}</td>
            <td>
                {{$menu->goods_price}}
            </td>
            <td>{{$menu->status ? '上架' : '下架'}}</td>
            <td>
                <img src="/{{$menu->goods_img}}" width="100">
            </td>


            <td>
                <a href="{{route('menu.edit',$menu->id)}}" class="btn btn-success">编辑</a>
                <a href="{{route('menu.del',$menu->id)}}" class="btn btn-danger">删除</a>
                @if($menu->status)
                    <a href="{{route('menu.xiajia',$menu->id)}}" class="btn btn-warning">下架</a>
                @else
                    <a href="{{route('menu.shangjia',$menu->id)}}" class="btn btn-primary">上架</a>
                 @endif
            </td>

        </tr>

    @endforeach

</table>
{{--分页--}}
<div class="pull-right">
    {{$menus->appends($url)->render()}}
</div>

    @endsection

{{--页头--}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<span><a class="navbar-brand" href="#">文章列表</a></span>--}}
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="">会员管理 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="">管理员管理 <span class="sr-only">(current)</span></a></li>--}}
                <li class="active"><a href="{{route('admin.shop.index')}}">店铺列表 <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shopcate.add')}}">添加分类</a></li>
                        <li><a href="{{route('shopcate.index')}}">分类列表</a></li>
                    </ul>
                </li>

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">添加店铺</a></li>--}}
                        {{--<li><a href="{{route('admin.shop.index')}}">店铺列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.user.add')}}">添加商家</a></li>
                        <li><a href="{{route('admin.user.index')}}">商家列表</a></li>
                    </ul>
                </li>
                {{--<li><a href="#">Link</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.add')}}">添加管理员</a></li>
                        <li><a href="{{route('admin.index')}}">管理员列表</a></li>
                    </ul>
                </li>
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                {{--@guest("admin")--}}
                {{--<li><a href="#">登录</a></li>--}}
                {{--<li><a href="#">注册</a></li>--}}
                {{--@endguest--}}

                @auth("admin")
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('admin.logout')}}">注销</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

{{--登录模态框--}}
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">欢迎登录</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">登录</button>
            </div>
        </div>
    </div>
</div>

{{--页头完--}}

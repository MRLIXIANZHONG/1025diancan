<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{\Illuminate\Support\Facades\Auth::user()->photo }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{route('shop.addone',\Illuminate\Support\Facades\Auth::user()->id)}}"><i class="fa fa-book"></i> <span>申请店铺</span></a></li>
            <li class="treeview">


            <li><a href="{{route('shop.indexone',\Illuminate\Support\Facades\Auth::user()->id)}}"><i class="fa fa-book"></i> <span>我的店铺</span></a></li>
            {{--<li><a href="{{route('shop.activity.index')}}"><i class="fa fa-book"></i> <span>活动公告</span></a></li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>活动</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('shop.activity.index')}}"><i class="fa fa-circle-o"></i>活动公告</a></li>
                    <li><a href="{{route('shop.event.index')}}"><i class="fa fa-circle-o"></i> 抽奖活动</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品分类</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('menucate.add')}}"><i class="fa fa-circle-o"></i>添加分类</a></li>
                    <li><a href="{{route('menucate.index')}}"><i class="fa fa-circle-o"></i> 分类列表</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('menu.add')}}"><i class="fa fa-circle-o"></i>添加菜品</a></li>
                    <li><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> 菜品列表</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品销量统计</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('shop.menu.day')}}"><i class="fa fa-circle-o"></i>按日统计</a></li>
                    <li><a href="{{route('shop.menu.month')}}"><i class="fa fa-circle-o"></i> 按月统计</a></li>
                    <li><a href="{{route('shop.menu.sum')}}"><i class="fa fa-circle-o"></i> 总统计</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>订单管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('shop.order.index')}}"><i class="fa fa-circle-o"></i>订单列表</a></li>
                    <li><a href="{{route('shop.order.sum')}}"><i class="fa fa-circle-o"></i> 订单统计</a></li>
                    <li><a href="{{route('shop.order.day')}}"><i class="fa fa-circle-o"></i> 订单按天统计</a></li>
                    <li><a href="{{route('shop.order.month')}}"><i class="fa fa-circle-o"></i> 订单按月统计</a></li>

                </ul>
            </li>



            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
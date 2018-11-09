<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//设置admin的路由分组
Route::domain(env('ADMIN_ROUT'))->namespace('Admin')->group(function () {

    //region 平台首页
    Route::get('/admin/index1','AdminController@index1')->name('admin.index1');

    //endregion

    //region设置店铺分类路由
    Route::get('/shopcate/index','ShoupCateController@index')->name('shopcate.index');
    #编辑店铺分类
    Route::any('/shopcate/edit/{id}','ShoupCateController@edit')->name('shopcate.edit');
    #添加店铺分类路由
    Route::any('/shopcate/add','ShoupCateController@add')->name('shopcate.add');
    #删除店铺分类路由
    Route::get('/shopcate/del/{id}','ShoupCateController@del')->name('shopcate.del');

    #店铺分类上线
    Route::get('/shopcate/shang/{id}','ShoupCateController@shang')->name('shopcate.shang');
    #店铺分类下线
    Route::get('/shopcate/xia/{id}','ShoupCateController@xia')->name('shopcate.xia');
    //endregion

    //region显示所有商家用户信息
    Route::get('/user/index','UserController@index')->name('admin.user.index');

    #编辑商家用户
    Route::any('/user/edit/{id}','UserController@edit')->name('admin.user.edit');

    #删除商家用户
    Route::get('/user/del/{id}','UserController@del')->name('admin.user.del');

    #后台添加商家用户
    Route::any('/user/add','UserController@add')->name('admin.user.add');

    //重置商家密码
    Route::any('/user/password/{id}','UserController@password')->name('admin.user.password');
//endregion

    //region添加管理员
    Route::any('/admin/add','AdminController@add')->name('admin.add');

    #显示所有管理员
    Route::any('/admin/index','AdminController@index')->name('admin.index');
    #编辑管理员
    Route::any('/admin/edit/{id}','AdminController@edit')->name('admin.edit');
    #删除管理员
    Route::any('/admin/del/{id}','AdminController@del')->name('admin.del');
    #重置管理员密码
    Route::any('/admin/password/{id}','AdminController@password')->name('admin.password');

    #管理员登录
    Route::any('/admin/login','AdminController@login')->name('admin.login');

    #管理员注销
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');
    //endregion

    //region店铺列表
    Route::get('/shop/index','ShopController@index')->name('admin.shop.index');

    #店铺添加
    Route::any('/shop/add/{id}','ShopController@add')->name('admin.shop.add');

    #店铺删除
    Route::get('/shop/del/{id}','ShopController@del')->name('admin.shop.del');

    #店铺修改
    Route::any('/shop/edit/{id}','ShopController@edit')->name('admin.shop.edit');

    #店铺审核
    Route::any('/shop/status/{id}','ShopController@status')->name('admin.shop.status');

    #店铺禁用
    Route::any('/shop/jingyong/{id}','ShopController@jingyong')->name('admin.shop.jingyong');
    #店铺取消禁用
    Route::any('/shop/quxiao/{id}','ShopController@quxiao')->name('admin.shop.quxiao');
    //endregion

    //region活动
    #添加活动
    Route::any('/activity/add','ActivityController@add')->name('admin.activity.add');
    #活动列表
    Route::get('/activity/index','ActivityController@index')->name('admin.activity.index');
    #编辑活动
    Route::any('/activity/edit/{id}','ActivityController@edit')->name('admin.activity.edit');
    #删除活动
    Route::any('/activity/del/{id}','ActivityController@del')->name('admin.activity.del');
    //endregion

    //region 前端用户
    //用户列表
    Route::get('/member/index','MemberController@index')->name('admin.member.index');

    //查询会员
    Route::get('/member/select','MemberController@select')->name('admin.member.select');

    //禁用会员
    Route::get('/member/status','MemberController@status')->name('admin.member.status');



    //endregion

    //region 订单统计
    //订单月统计
    Route::get('/order/month','OrderController@month')->name('admin.order.month');

    //订单日统计
    Route::any('/order/day','OrderController@day')->name('admin.order.day');

    //订单总统计
    Route::any('/order/sum','OrderController@sum')->name('admin.order.sum');

    //endregion

    //region 菜品统计
    //订单月统计
    Route::get('/menu/month','MenuController@month')->name('admin.menu.month');

    //菜品日统计
    Route::get('/menu/day','MenuController@day')->name('admin.menu.day');

    //菜品总统计
    Route::get('/menu/sum','MenuController@sum')->name('admin.menu.sum');

    //endregion

    //region 权限管理
    # 添加权限
    Route::any('/permission/add','PermissionController@add')->name('admin.permission.add');
    # 编辑权限
    Route::any('/permission/edit/{id}','PermissionController@edit')->name('admin.permission.edit');
    # 权限列表
    Route::get('/permission/index','PermissionController@index')->name('admin.permission.index');
    # 删除权限
    Route::get('/permission/del/{id}','PermissionController@del')->name('admin.permission.del');



    //endregion

    //region 角色管理
    # 添加角色
    Route::any('/role/add','RoleController@add')->name('admin.role.add');

    # 角色列表
    Route::get('/role/index','RoleController@index')->name('admin.role.index');

    # 编辑角色
    Route::any('/role/edit/{id}','RoleController@edit')->name('admin.role.edit');

    # 角色详情
    Route::any('/role/ones/{id}','RoleController@ones')->name('admin.role.ones');

    # 删除角色
    Route::any('/role/del/{id}','RoleController@del')->name('admin.role.del');

    //endregion

    //region 菜单栏管理
    //添加菜单
    Route::any('/navs/add','NavsController@add')->name('admin.navs.add');
    //编辑菜单
    Route::any('/navs/edit/{id}','NavsController@edit')->name('admin.navs.edit');
    //菜单列表
    Route::any('/navs/index','NavsController@index')->name('admin.navs.index');
    //菜单删除
    Route::any('/navs/del/{id}','NavsController@del')->name('admin.navs.del');


    //endregion

    //region 抽奖
    //添加抽奖活动
    Route::any('/event/add','EventController@add')->name('admin.event.add');
    //编辑抽奖活动
    Route::any('/event/edit/{id}','EventController@edit')->name('admin.event.edit');
    //删除抽奖活动
    Route::get('/event/del/{id}','EventController@del')->name('admin.event.del');
    //抽奖活动列表
    Route::any('/event/index','EventController@index')->name('admin.event.index');
    Route::get('/event/on/{id}','EventController@on')->name('admin.event.on');



    //endregion

    //region 奖品
    //添加奖品
    Route::any('/eventPrize/add/{id}','EventPrizeController@add')->name('admin.eventPrize.add');
    //删除奖品
    Route::get('/eventPrize/del{id}','EventPrizeController@del')->name('admin.eventPrize.del');
    //编辑奖品
    Route::any('/eventPrize/edit/{id}','EventPrizeController@edit')->name('admin.eventPrize.edit');
    //显示奖品
    Route::get('/eventPrize/index/{id}','EventPrizeController@index')->name('admin.eventPrize.index');

    //endregion

    //region 抽奖报名
    //查看报名信息
    Route::any('/eventUser/index/{id}','EventUserController@index')->name('admin.eventUser.index');

    //endregion

    #公共upload添加图片
    Route::any('/shop/upload','ShopController@upload')->name('admin.shop.upload');

});




//设置shop的路由分组
Route::domain(env('SHOP_ROUT'))->namespace('Shop')->group(function () {

    //region设置商家后台首页
    Route::get('/user/indexs','UserController@indexs')->name('user.indexs');
    #商家注册
    Route::any('/user/add','UserController@add')->name('user.add');
    #编辑商家用户资料
    Route::any('/user/edit/{id}','UserController@edit')->name('user.edit');

    #商家登录
    Route::any('/user/login','UserController@login')->name('user.login');
    #商家注销
    Route::any('/user/logout','UserController@logout')->name('user.logout');

    #商家添加商铺
    Route::any('/shop/addone/{id}','ShopController@addone')->name('shop.addone');

    #商家注册后添加商铺
    Route::any('/shop/shopadd','ShopController@shopadd')->name('shop.shopadd');

    #商家显示店铺
    Route::any('/shop/indexone/{id}','ShopController@indexone')->name('shop.indexone');

    #商家编辑店铺
    Route::any('/shop/edit/{id}','ShopController@edit')->name('shop.editone');
    //endregion

    //region菜品
    #添加菜品
    Route::any('/menu/add','MenuController@add')->name('menu.add');
    #菜品列表
    Route::any('/menu/index','MenuController@index')->name('menu.index');
    #编辑菜品
    Route::any('/menu/edit/{id}','MenuController@edit')->name('menu.edit');
    #删除菜品
    Route::any('/menu/del/{id}','MenuController@del')->name('menu.del');
    #菜品下架
    Route::any('/menu/xiajia/{id}','MenuController@xiajia')->name('menu.xiajia');
    #菜品上架
    Route::any('/menu/shangjia/{id}','MenuController@shangjia')->name('menu.shangjia');
    //endregion

    //region菜品分类
    #添加菜品分类
    Route::any('/menucate/add','MenuCategoryController@add')->name('menucate.add');
    #菜品分类列表
    Route::any('/menucate/index','MenuCategoryController@index')->name('menucate.index');
    #编辑菜品分类
    Route::any('/menucate/edit/{id}','MenuCategoryController@edit')->name('menucate.edit');
    #删除菜品分类
    Route::any('/menucate/del/{id}','MenuCategoryController@del')->name('menucate.del');
    #设置默认菜品分类
    Route::any('/menucate/moren/{id}','MenuCategoryController@moren')->name('menucate.moren');
    //endregion

    //region 活动
    #显示活动
    Route::any('/Activity/index','ActivityController@index')->name('shop.activity.index');

    //抽奖活动
    Route::get('/event/index','EventController@index')->name('shop.event.index');
    //报名抽奖
    Route::any('/event/luck/{id}','EventController@luck')->name('shop.event.luck');
    //查看抽奖活动
    Route::any('/event/select/{id}','EventController@select')->name('shop.event.select');


    //endregion

    //region 公共上传图片
    #公共upload添加图片
    Route::any('/shop/upload','ShopController@upload')->name('admin.shop.upload');
    //endregion

    //region 订单
    //订单列表
    Route::get('/order/index','OrderController@index')->name('shop.order.index');

    //订单发货
    Route::get('/order/status/{id}','OrderController@status')->name('shop.order.status');

    //订单详情
    Route::any('/order/detail/{id}','OrderController@detail')->name('shop.order.detail');

    //订单统计
    #总统计
    Route::any('/order/sum','OrderController@sum')->name('shop.order.sum');

    #按日统计
    Route::any('/order/day','OrderController@day')->name('shop.order.day');
    #按月统计
    Route::any('/order/month','OrderController@month')->name('shop.order.month');
    //endregion

    //region 菜品销量
    #按月统计
    Route::any('/menu/month','MenuController@month')->name('shop.menu.month');

    #按日统计
    Route::any('/menu/day','MenuController@day')->name('shop.menu.day');

    #总统计统计
    Route::any('/menu/sum','MenuController@sum')->name('shop.menu.sum');

    //endregion

});



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
    return view('welcome');
});

//设置admin的路由分组
Route::domain('admin.mt.com')->namespace('Admin')->group(function () {
    #设置店铺分类路由
    Route::get('/shopcate/index','ShoupCateController@index')->name('shopcate.index');
    #编辑店铺分类
    Route::any('/shopcate/edit/{id}','ShoupCateController@edit')->name('shopcate.edit');
    #添加店铺分类路由
    Route::any('/shopcate/add','ShoupCateController@add')->name('shopcate.add');
    #删除店铺分类路由
    Route::get('/shopcate/del/{id}','ShoupCateController@del')->name('shopcate.del');

    #显示所有商家用户信息
    Route::get('/user/index','UserController@index')->name('admin.user.index');

    #编辑商家用户
    Route::any('/user/edit/{id}','UserController@edit')->name('admin.user.edit');

    #删除商家用户
    Route::get('/user/del/{id}','UserController@del')->name('admin.user.del');

    #后台添加商家用户
    Route::any('/user/add','UserController@add')->name('admin.user.add');

    #重置商家密码
    Route::any('/user/password/{id}','UserController@password')->name('admin.user.password');

    #添加管理员
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

    #店铺列表
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

});

//设置shop的路由分组
Route::domain('shop.mt.com')->namespace('Shop')->group(function () {
    #设置商家后台首页
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
    #商家显示店铺
    Route::any('/shop/indexone/{id}','ShopController@indexone')->name('shop.indexone');

    #商家编辑店铺
    Route::any('/shop/edit/{id}','ShopController@edit')->name('shop.editone');

    #菜品
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


    #菜品分类
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




});



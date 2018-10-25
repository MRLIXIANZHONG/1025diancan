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
    #设置商家分类路由
    Route::get('/shopcate/index','ShoupCateController@index')->name('shopcate.index');
    #编辑商家分类
    Route::any('/shopcate/edit/{id}','ShoupCateController@edit')->name('shopcate.edit');
    #添加商家分类路由
    Route::any('/shopcate/add','ShoupCateController@add')->name('shopcate.add');
    #删除商家分类路由
    Route::get('/shopcate/del/{id}','ShoupCateController@del')->name('shopcate.del');

});

//设置shop的路由分组
Route::domain('shop.mt.com')->namespace('Shop')->group(function () {

    #设置商家显示页面首页
    Route::get('/user/index','UserController@index')->name('user.index');
    #设置商家添加用户
    Route::any('/user/add','UserController@add')->name('user.add');
    #设置商家编辑
    Route::any('/user/edit/{id}','UserController@edit')->name('user.edit');
    #设置商家删除
    Route::get('/user/del/{id}','UserController@del')->name('user.del');
    #设置商家登录
    Route::any('/user/login','UserController@login')->name('user.login');
    #设置注销
    Route::any('/user/logout','UserController@logout')->name('user.logout');


    #商家添加商铺
    Route::any('/shop/addone/{id}','ShopController@addone')->name('shop.addone');
    #后台添加商铺
    Route::any('/shop/add/','ShopController@add')->name('shop.add');
    #商家显示店铺
    Route::any('/shop/indexone/{id}','ShopController@indexone')->name('shop.indexone');
    #后台显示店铺
    Route::any('/shop/index','ShopController@index')->name('shop.index');
    #后台编辑商铺
    Route::any('/shop/edit/{id}','ShopController@edit')->name('shop.edit');
    #商家编辑商铺
    Route::any('/shop/editone/{id}','ShopController@editone')->name('shop.editone');
    Route::get('/shop/del/{id}','ShopController@del/{id}')->name('shop.del/{id}');

});



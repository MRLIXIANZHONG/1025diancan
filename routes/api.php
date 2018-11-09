<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//商户列表
Route::get('/shop/index','Api\ShopController@index');
//商品列表
Route::get('/shop/menuList','Api\ShopController@menuList');
//短信验证
Route::get('/member/sms','Api\MemberController@sms');
//会员注册
Route::post('/member/reg','Api\MemberController@reg');
//会员登录
Route::post('/member/login','Api\MemberController@login');
//重置密码
Route::post('/member/editPassword','Api\MemberController@editPassword');
//修改密码
Route::post('/member/setPassword','Api\MemberController@setPassword');
//个人资料
Route::get('/member/userDetail','Api\MemberController@userDetail');

//添加购物车
Route::post('/cart/add','Api\CartController@add');
//购物车
Route::get('/cart/cart','Api\CartController@cart');
//添加收货地址
Route::post('/memberaddress/add','Api\MemberAddressController@add');
//收货地址列表
Route::get('/memberaddress/addressList','Api\MemberAddressController@addressList');
//地址显示，用于修改回显地址
Route::get('/memberaddress/address','Api\MemberAddressController@address');
//修改地址
Route::post('/memberaddress/addressEdit','Api\MemberAddressController@addressEdit');

//添加订单
Route::any('/order/addOrder','Api\OrderController@addOrder');

//订单详情
Route::get('/order/order','Api\OrderController@order');
//订单列表
Route::get('/order/orderList','Api\OrderController@orderList');

//余额支付
Route::post('/order/pay','Api\OrderController@pay');

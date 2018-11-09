<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{


    public function __construct()
    {
        $this->middleware("auth:admin",[
            "except"=>["login"]
        ]);

        //权限判断
        $this->middleware(function ($request, \Closure $next){
            //如果没有权限  停在这里
            //1. 得到当前访问地址的路由
            $route=Route::currentRouteName();

            //2.设置一个白名单
            $allow=[
                "admin.login",
                "admin.logout",
                "admin.index1"
            ];
            //2.判断当前登录用户有没有权限
            //2.1 判断是否为白名单，判断权限，判断是否为管理员登录
            if (!in_array($route,$allow) &&!Auth::guard("admin")->user()->can($route) && Auth::guard("admin")->id()!=1){

                exit(view("admin.tishi.tishi"));
            }

            return $next($request);

        });


    }
}

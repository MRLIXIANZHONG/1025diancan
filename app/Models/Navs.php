<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Navs extends Model
{
    //允许更改的字段
    protected $fillable=[
      'name','url','pid','permission_id'
    ];

    //菜单栏按权限显示
    public static function navs1(){

        //判断当前用户登录没有
        $admin = Auth::guard('admin')->user();
        $navs = self::where('pid',0)->get();//得到所有一级菜单

        if ($admin && $admin->id !=1){


            //判断当前用户的权限
            foreach ($navs as $k=>$roue){

                $navs2 = self::where('pid',$roue->id)->first();//找到一级菜单下的所有二级菜单

                if (!$navs2 || !$admin->can($navs2->url)) {//判断没有权限，或者没有子菜单就干掉

                    unset($navs[$k]);
                }

                }
                return $navs;

        }else{

           return $navs;
        }


    }
}

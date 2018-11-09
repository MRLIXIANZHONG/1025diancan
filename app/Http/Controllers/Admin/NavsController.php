<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavsController extends BaseController
{
    //添加菜单栏菜单
    public function add(Request $request){

        if ($request->isMethod('post')){
            //数据验证
            $data=$this->validate($request,[
                'name'=>'required',
                'url'=>'required',
                'pid'=>'required',
            ]);

            //入库
            if (Navs::create($data)) {
                //刷新跳转
                echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            }

        }
        //得到所有路由
        $app = app();
        $path=[];//定义一个存储路由别名的数组
        $routes = $app->routes->getRoutes();//获取所有路由
        foreach ($routes as $k=>$value){

           // dd($value->action['namespace']);
            //判断是否存在命名空间，如果存在就判断命名空间是否属于admin，最后再取别名
            if (isset($value->action['namespace'])&& $value->action['namespace']=='App\Http\Controllers\Admin'){
                $path[]= $value->action['as'];
            }

        }
        //读出数据库中的路由
        $url = Navs::pluck('url')->toArray();
        //去掉两个数组相同的数据
       // $s = array_intersect($url,$path);
       $urls=array_diff($path,$url);
        //显示视图
        return view('admin.navs.add',compact('path','urls'));

    }
}

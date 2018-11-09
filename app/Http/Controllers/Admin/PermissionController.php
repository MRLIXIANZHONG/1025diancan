<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    //添加权限
    public function add(Request $request){

        if ($request->isMethod('post')){

            //接受数据
            $data = $request->post();
           //添加保安
            $data['guard_name']='admin';
            //添加权限
            if (Permission::create($data)) {
                //添加成功
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
        $url = Permission::pluck('name')->toArray();
        //去掉两个数组相同的数据
        // $s = array_intersect($url,$path);
        $urls=array_diff($path,$url);

        //显示视图
        return view('admin.permission.add',compact('urls'));

    }

    //编辑权限
    public function edit(Request $request,$id){
        $per = Permission::find($id);
        if ($request->isMethod('post')){
            //验证数据
            $this->validate($request,[
               'name'=>'required',
               'intro'=>'required',
            ]);
            $data = [
                'name'=>$request->post('name'),
                'intro'=>$request->post('intro')
            ];
            $per->update($data);
            //跳转
            return redirect()->route('admin.permission.index')->with('success','编辑成功');

        }
        //视图
        return view('admin.permission.edit',compact('per'));


    }

    //权限列表
    public function index(Request $request){
        $pers = Permission::paginate(10);

        return view('admin.permission.index',compact('pers'));
    }
    //删除权限
    public function del(Request $request,$id){

        $per = Permission::find($id);
        $per->delete();
        return redirect()->route('admin.permission.index')->with('danger','删除成功');
    }
}

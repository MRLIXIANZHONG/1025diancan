<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function Sodium\compare;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    //添加角色
    public function add(Request $request){

        if ($request->isMethod('post')){

            $data =[
              'name'=>$request->post('name'),
                'guard_name'=>'admin'
            ];
            //添加角色

            $role = Role::create($data);
            //权限
            $pers = $request->post('per');

            //同步权限
            if ($pers){
                $role->syncPermissions($pers);
            }
            //返回
            return redirect()->route('admin.role.index')->with('success','添加成功');


        }
        //得到所有权限
        $pers = Permission::all();
        //显示视图
        return view('admin.role.add',compact('pers'));

    }
    //修改角色
    public function edit(Request $request,$id){
        //得到当前角色
        $role = Role::find($id);
        if ($request->isMethod('post')){
            $data = [
                'name'=>$request->post('name'),
            ];
            //编辑数据
             $role->update($data);
            //接受数据
            $pers = $request->post('per');
            //同步权限
            if ($pers){
                $role->syncPermissions($pers);
            }
            //跳转
            return redirect()->route('admin.role.index')->with('success','编辑成功');
        }

        //查找所有权限
        $pers = Permission::all();

        //得到当前角色权限
        //dd($role->hasPermissionTo(17));//检查当前角色是否拥有权限，可以说权限id也可以是权限路由
        $cper =$role->getAllPermissions()->pluck('id');//查看角色所有权限id


        //显示视图
        return view('admin.role.edit',compact('role','pers','cper'));


    }

    //角色列表
    public function index(Request $request){

        $roles = Role::paginate(10);
        //显示视图
        return view('admin.role.index',compact('roles'));
    }

    //角色详情
    public function ones(Request $request,$id){

        $role = Role::find($id);

        //查看当前角色的权限

        $pers=$role->permissions()->pluck('intro');
        //显示视图
        return view('admin.role.ones',compact('role','pers'));
    }

    //删除角色
    public function del(Request $request,$id){
        $role = Role::find($id);
        $role->delete();
        //跳转
        return redirect()->route('admin.role.index')->with('danger','删除成功');

    }


}

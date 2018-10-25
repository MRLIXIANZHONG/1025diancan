<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    //管理员列表
    public function index(){
        //找到所有管理员
        $admins = Admin::paginate(10);
        return view('admin.admin.index',compact('admins'));
    }
    //添加管理员
    public function add(Request $request){
        //post提交
        if ($request->isMethod('post')){
            //验证数据
           $data= $this->validate($request,[
                'name'=>'required|unique:admins',
                'password'=>'required|min:6|max:12|confirmed',
                'email'=>'required',
            ]);
//           密码加密
            $data['password']=bcrypt($data['password']);
            //添加数据
            if (Admin::create($data)) {
                //提示
                session()->flash('success','添加成功');
                //跳转
                return redirect()->route('admin.index');
            }
        }
        //显示视图
        return view('admin.admin.add');
    }
    //编辑管理员
    public function edit(Request $request,$id){
        $admin = Admin::find($id);
        //post提交
        if ($request->isMethod('post')){
            //验证
           $data= $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
               'password'=>'required|min:6|max:12|confirmed',
            ]);
           //密码加密
            $data['password']=bcrypt($data['password']);
            //编辑
            if ($admin->update($data)) {
                //提示
                session()->flash('success','编辑成功');
                //跳转
                return redirect()->route('admin.index');
            }

        }
        //显示视图
        return view('admin.admin.edit',compact('admin'));

    }

    //重置密码
    public function password($id){
        $admin = Admin::find($id);
        $admin->password = bcrypt('123456');
        if ($admin->save()) {
            //提示
            session()->flash('success','重置成功，密码为123456');
            //跳转
            return redirect()->route('admin.index');
        }

    }
    //删除管理员
    public function del($id){

        $admin = Admin::find($id);
        if ($admin->delete()) {
            //提示
            session()->flash('danger','删除成功');
            //跳转
            return redirect()->route('admin.index');
        }

    }

    //管理员登录
    public function login(Request $request){

        //post提交
        if ($request->isMethod('post')){
            //数据验证
           $data= $this->validate($request,[
               'name'=>'required',
               'password'=>'required'
            ]);

           //判断数据
            if (Auth::guard('admin')->attempt($data)){
                //跳转
                return redirect()->route('admin.index')->with('info','登录成功');
            }else{
                return back()->with('danger','账号密码错误');
            }

        }
      //显示视图
        return view('admin.admin.login');

    }

    //管理员注销
    public function logout(){
       Auth::guard('admin')->logout();
        //提示
        session()->flash('info','注销成功');
        //跳转
        return redirect()->route('admin.login');
    }

}

<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{


    //显示商家后台首页
    public function indexs(){
        //显示视图
        return view('shop.user.index1');
    }

    //用户注册
    public function add(Request $request){

        //post提交
        if ($request->isMethod('post')){

            //验证
            $this->validate($request,[
               'name'=>'required|unique:users',
                'password'=>'required|confirmed|min:6|max:12',
                'email'=>'email',
                'photo'=>'required|image',
                'captcha'=>'required|captcha',
                'tel'=>'regex:/^1[34578]\d{9}$/'
            ],[
                'tel.regex'=>'请输入合法电话号码'
            ]);
            //接受数据
            $data = $request->post();

            //密码加密
            $data['password']=bcrypt($data['password']);
            //接受图片
            $data['photo']=$request->file('photo')->store('shop/user','image');

            //添加数据
            if (User::create($data)) {
                //提示
                session()->flash('success','注册成功');
                //跳转
                return redirect()->route('user.login');
            }
        }
        //显示视图
        return view('shop.user.add');
    }
    //编辑用户
    public function edit(Request $request,$id){
        $user = User::find($id);
        //post提交
        if($request->isMethod('post')){

            //验证数据
            $this->validate($request,[
                'name'=>'required|unique:admins',
                'photo'=>'image',
                'tel'=>'regex:/^1[34578]\d{9}$/',
                'email'=>'email',

            ],[
                'tel.regex'=>'请输入合法电话号码'
            ]);
            //接收值
            $data = $request->post();
            if($data['password']!=null){
                $this->validate($request,[
                    'password'=>'min:6|max:12|confirmed'
                ]);
                //密码加密
                $data['password']=bcrypt($data['password']);
            }
            //判断是否上传了图片
            if($request->file('photo')!=null){
                $data['photo']=$request->file('photo')->store('shop/user','image');
                //删除原图片
                @unlink($request->post('oldp'));
            }
            //如果没有输入密码就不更改密码
            if($data['password']==null){
                unset($data['password']);
            }
            //更改数据
            if ($user->update($data)) {
                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('user.indexs');

            }
        }
        //显示视图
        return view('shop.user.edit',compact('user'));
    }


    //商家登录
    public function login(Request $request){

        //post提交
        if($request->isMethod('post')){
            //验证
          $data = $this->validate($request,[
                'name'=>'required',
                'password'=>'required'
            ]);
            //接s收数据

            //验证密码是否正确
            if(Auth::attempt($data,$request->has('remember'))){
                return redirect()->route('user.indexs')->with('success','登录成功');
            }else{
                return redirect()->back()->withInput()->with("danger","账号密码错误");
            }
        }
        //显示视图
        return view('shop.user.login');
    }

    //注销
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route("user.login");
    }


}

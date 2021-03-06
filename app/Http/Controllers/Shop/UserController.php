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
                'photo'=>'required',
                'captcha'=>'required|captcha',
                'tel'=>'regex:/^1[34578]\d{9}$/'
            ],[
                'tel.regex'=>'请输入合法电话号码'
            ]);
            //接受数据
            $data = $request->post();
            //密码加密
            $data['password']=bcrypt($data['password']);
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
            //如果没有上传图片就不改图片
            if ($data['photo']==null){
                unset($data['photo']);
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
            //验证密码是否正确
            if(Auth::attempt($data)){
                //登录成功后判断是否有商铺
                $user =Auth::user();
                $shop = $user->shop;
                if(!$shop){
                    return redirect()->route('shop.shopadd')->with('success','你还没有商铺，请添加商铺');
                }
                switch ($shop->status){
                    case 0:
                    return back()->with('danger','店铺未审核');
                    break;
                    case -1;
                    return back()->with('danger','店铺被禁用');
                    break;
                }
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
        //注册成功后添加账户
        return redirect()->route("user.login");
    }


}

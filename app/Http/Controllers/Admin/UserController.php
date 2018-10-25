<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    //显示所用用户
    public function index(){

        //得到所有数据
        $users= User::paginate(6);
        //显示视图
        return view('admin.user.index',compact('users'));
    }

    //删除用户
    public function del($id){
        $row =User::find($id);
        $photo = $row->photo;
        //查看是否有店铺信息
        $shop = Shop::where('user_id',$id)->get();

        if ($row->delete()) {
            //删除图片
            @unlink($photo);
            //删除商铺
            DB::table('shops')->where('user_id',  $id)->delete();
            //删除店铺图片
            @unlink($shop->shop_img);
        }
        //提示
        session()->flash("danger","删除成功");
        //跳转视图
        return redirect()->route('admin.user.index');
    }

    //添加用户
    public function add(Request $request)
    {

        //post提交
        if ($request->isMethod('post')) {

            //验证
            $this->validate($request, [
                'name' => 'required|unique:users',
                'password' => 'required|confirmed|min:6|max:12',
                'email' => 'email',
                'photo' => 'required|image',
                'captcha' => 'required|captcha',
                'tel' => 'regex:/^1[34578]\d{9}$/'
            ], [
                'tel.regex' => '请输入合法电话号码'
            ]);
            //接受数据
            $data = $request->post();

            //密码加密
            $data['password'] = bcrypt($data['password']);
            //接受图片
            $data['photo'] = $request->file('photo')->store('shop/user', 'image');

            //添加数据
            if (User::create($data)) {
                //提示
                session()->flash('success', '添加成功');
                //跳转
                return redirect()->route('admin.user.index');
            }
        }
        //显示视图
        return view('admin.user.add');

    }
    //编辑商家用户信息
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
                return redirect()->route('admin.user.index');

            }
        }
        //显示视图
        return view('admin.user.edit',compact('user'));
    }

    //重置商家密码
    public function password($id){
        $suer = User::find($id);
        $suer->password = bcrypt('123456');
        $suer->save();
        //提示
        session()->flash('success','重置成功，密码123456');
        return back();
    }


}

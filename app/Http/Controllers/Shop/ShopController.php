<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShoupCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopController extends BaseController
{
    //显示商家店铺信息
    public function indexone($id){
        //找到店铺
       $ones= Shop::all()->where('user_id',$id);
       // dd($one[2]->shopcate);
        //显示视图
        return view('shop.shop.index',compact('ones'));

    }
    //商家添加店铺
    public function addone(Request $request,$id){
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all()->where("status",'1');
        //dd($shopcates);
        //由于一个商家只能添加一个店铺，所以，要先查询店铺信息表
        //查询店铺信息表
        $shopone = Shop::all()->where('user_id',$id);

        if(count($shopone)){
            //提示
            session()->flash('warning','你已经有商铺了');
            //跳转
            return redirect()->route('user.indexs');
        }
        //post提交
        if ($request->isMethod('post')){
            //验证数据
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required|unique:shops',
                'shop_img'=>'required',
                'start_send'=>'required|numeric|min:1',
                'send_cost'=>'required|numeric|min:1',
                'captcha'=>'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            $data['user_id']=$id;
            //提交数据
            if(Shop::create($data)){
                //提示
                session()->flash('success','操作完成，等待审核');
                return redirect()->route('user.login');
            }
        }
        //显示视图
        return view('shop.shop.add',compact('shopcates'));

    }


    //注册成功后，直接添加商铺
    public function shopadd(Request $request){
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all()->where("status",'1');
        //post提交
        if ($request->isMethod('post')){
//            $user = User::where('name',$request->post('name'))->get();
//            dd(count($user));
            //验证数据
            $this->validate($request,[
                'name'=>'required',
                'shop_category_id'=>'required',
                'shop_name'=>'required|unique:shops',
                'shop_img'=>'required',
                'start_send'=>'required|numeric|min:1',
                'send_cost'=>'required|numeric|min:1',
                'captcha'=>'required|captcha',
            ]);
            //通过用户名找到刚才注册的id
            $user = User::where('name',$request->post('name'))->get();

            if(!count($user)){
                return back()->with('danger','用户名不存在');
            }
           $id=$user[0]->id;

            //由于一个商家只能添加一个店铺，所以，要先查询店铺信息表
            //查询店铺信息表
            $shopone = Shop::all()->where('user_id',$id);
            if(count($shopone)){
                //提示
                session()->flash('warning','你已经有商铺了');
                //跳转
                return redirect()->route('user.indexs');
            }
            //接受数据
            $data = $request->post();
            $data['user_id']=$id;
            //提交数据
            if(Shop::create($data)){
                //提示
                session()->flash('success','操作完成，等待审核');
                return redirect()->route('user.login');
        }

        }
        //显示视图
        return view('shop.shop.shopadd',compact('shopcates'));

    }










    //商家自己修改店铺
    public function edit(Request $request,$id){

        //找到店铺信息
        $one = Shop::find($id);
        //得到所有分类信息
        $shopcates = ShoupCategory::all();
        //post提交
        if($request->isMethod('post')){

            //验证数据
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>[
                    'required',
                    Rule::unique('shops')->ignore($one->id),
                ],
                'start_send'=>'required|numeric|min:1',
                'send_cost'=>'required|numeric|min:1',
                'captcha'=>'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            //如果没有上传图片就不修改图片
            if ($data['shop_img']==null){
                unset($data['shop_img']);
            }
            //提交数据
            if($one->update($data)){
                //提示
                session()->flash('success','编辑完成，等待审核');
                return redirect()->route('user.indexs');
            }

        }
        //显示视图
        return view('shop.shop.edit',compact('one','shopcates'));

    }



    //upload上传图片
    public function upload(Request $request){

        //处理上传

        // dd($request->file("file"));

        $file=$request->file("file");
        if ($file){
            //上传
            $url=$file->store("shop");
            //得到真实地址  加 http的址
            $url=Storage::url($url);
            //这把必须用数组的方式保存图片路径，然后返回，前端才可以得到对应的图片路径
            //这把用什么值，那边就接受什么值
            $data['url']=$url;

            return $data;

        }

    }


}

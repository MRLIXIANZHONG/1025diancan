<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShoupCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends BaseController
{
    //显示全部店铺信息
    public function index(){

    }

    //显示商家店铺信息
    public function indexone($id){

        //找到店铺
       $one= Shop::all()->where('user_id',$id);
        //dd($one[0]->shopcate->name);
        //显示视图

        return view('shop.shop.index',compact('one'));

    }
    //商家添加店铺
    public function addone(Request $request,$id){
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all();
        //dd($shopcates);
        //由于一个商家只能添加一个店铺，所以，要先查询店铺信息表
        //查询店铺信息表
        $shopone = Shop::all()->where('user_id',$id);

        if(count($shopone)){
            //提示
            session()->flash('warning','你已经有商铺了');
            //跳转
            return redirect()->route('user.index');
        }
        //post提交
        if ($request->isMethod('post')){
            //验证数据
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'shop_img'=>'required|image',
                'start_send'=>'required|numeric|min:1',
                'send_cost'=>'required|numeric|min:1',
                'captcha'=>'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            $data['user_id']=$id;
            //接受图片
            $data['shop_img']=$request->file('shop_img')->store('shop/shop_img','image');
            //提交数据
            if(Shop::create($data)){
                //提示
                session()->flash('success','操作完成，等待审核');
                return redirect()->route('user.index');
            }
        }
        //显示视图
        return view('shop.shop.add',compact('shopcates'));

    }

    //后台添加店铺
    public function add(Request $request)
    {
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all();
        //得到所有商家信息
        $users = User::all();

        //post提交
        if ($request->isMethod('post')) {
            //验证数据
            $this->validate($request, [
                'shop_category_id' => 'required',
                'shop_name' => 'required',
                'shop_img' => 'required|image',
                'start_send' => 'required|numeric|min:1',
                'send_cost' => 'required|numeric|min:1',
                'captcha' => 'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            //接受图片
            $data['shop_img'] = $request->file('shop_img')->store('shop/shop_img', 'image');
            //提交数据
            if (Shop::create($data)) {
                //提示
                session()->flash('success', '操作完成，等待审核');
                return redirect()->route('user.index');
            }

        }
        //显示视图
        return view('shop.shop.adds', compact('shopcates','users'));
    }


    //商家自己修改店铺
    public function editone(Request $request,$id){

        //找到店铺信息
        $one = Shop::find($id);
        //得到所有分类信息
        $shopcates = ShoupCategory::all();
        //post提交
        if($request->isMethod('post')){

            //验证数据
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required',
                'shop_img'=>'required|image',
                'start_send'=>'required|numeric|min:1',
                'send_cost'=>'required|numeric|min:1',
                'captcha'=>'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            //判断是否上传了图片
            if($request->file('shop_img')!=null){
                $data['shop_img']=$request->file('shop_img')->store('shop/shop_img','image');
                //删除原图片
                @unlink($request->post('oldp'));
            }
            //提交数据
            if($one->update($data)){
                //提示
                session()->flash('success','编辑完成，等待审核');
                return redirect()->route('user.index');
            }

        }
        //显示视图
        return view('shop.shop.edit',compact('one','shopcates'));

    }
    //后台修改店铺
    public function edit(Request $request,$id){

    }

    //删除店铺
    public function del($id){

    }

}

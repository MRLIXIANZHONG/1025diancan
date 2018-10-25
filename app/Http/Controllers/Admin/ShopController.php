<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShoupCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
    //显示全部店铺信息
    public function index(){
        $shops = Shop::paginate(10);
        //显示视图
        return view('admin.shop.index',compact('shops'));
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
                return redirect()->route('admin.user.index');
            }

        }
        //显示视图
        return view('admin.shop.adds', compact('shopcates','users'));
    }

    //后台修改店铺
    public function edit(Request $request,$id){
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all();
        //得到所有商家信息
        $users = User::all();
        //得到一条店铺信息做回显
        $shop = Shop::find($id);

        //post提交
        if ($request->isMethod('post')){
            //验证数据
            //验证数据
            $this->validate($request, [
                'shop_category_id' => 'required',
                'shop_name' => 'required',
                'shop_img' => 'image',
                'start_send' => 'required|numeric|min:1',
                'send_cost' => 'required|numeric|min:1',
            ]);
            //接受数据
            $data = $request->post();
            //判断是否上传了图片
            if($request->file('shop_img')!=null){
                $data['photo']=$request->file('shop_img')->store('shop/shop_img','image');
                //删除原图片
                @unlink($request->post('oldp'));
            }
            //更新数据
            if ($shop->update($data)) {
                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('admin.user.index');
            }


        }
        //显示视图
        return view('admin.shop.edit', compact('shopcates','users','shop'));



    }

    //删除店铺
    public function del($id){
        $row =Shop::find($id);
        $photo = $row->shop_img;
        //查看是否有店铺信息
        if ($row->delete()) {
            //删除图片
            @unlink($photo);
        }
        //提示
        session()->flash("danger","删除成功");
        //跳转视图
        return redirect()->route('admin.user.index');

    }

    //店铺审核
    public function status($id){

        //找到shop
        $shop = Shop::find($id);
        $shop->status =1;
        if ($shop->save()) {
            //提示
            session()->flash("success","审核通过");
            //跳转视图
            return back();
        }

    }
    //禁用
    public function jingyong($id){
        //找到shop
        $shop = Shop::find($id);
        $shop->status = -1;
        if ($shop->save()) {
            //提示
            session()->flash("danger","已禁用");
            //跳转视图
            return back();
        }
    }

    //取消禁用
    public function quxiao($id){
        //找到shop
        $shop = Shop::find($id);
        $shop->status = 1;
        if ($shop->save()) {
            //提示
            session()->flash("danger","取消禁用");
            //跳转视图
            return back();
        }
    }

}

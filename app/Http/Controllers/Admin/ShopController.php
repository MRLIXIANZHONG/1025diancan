<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShoupCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopController extends BaseController
{
    //显示全部店铺信息
    public function index(){
        $shops = Shop::orderBy('status','asc')->paginate(10);
        //显示视图
        return view('admin.shop.index',compact('shops'));
    }

    //后台添加店铺
    public function add(Request $request,$id)
    {
        //得到所有店铺分类信息
        $shopcates = ShoupCategory::all();

        if ($request->isMethod('post')) {

            //验证数据
            $this->validate($request, [
                'shop_category_id' => 'required',
                'shop_name' => 'required|unique:shops',
                'shop_img' => 'required',
                'start_send' => 'required|numeric|min:1',
                'send_cost' => 'required|numeric|min:1',
                'captcha' => 'required|captcha',
            ]);
            //接受数据
            $data = $request->post();
            $data['user_id']=$id;
            $data['status']=1;
            //接受图片
//            $data['shop_img'] = $request->file('shop_img')->store('shop/shop_img', 'image');
            //提交数据
            if (Shop::create($data)) {
                //提示
                session()->flash('success', '添加成功');
                return redirect()->route('admin.shop.index');
            }

        }
        //显示视图
        return view('admin.shop.adds', compact('shopcates'));
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
                'shop_name' => [
                    'required',
                    Rule::unique('shops')->ignore($shop->id),
                ],
                'start_send' => 'required|numeric|min:1',
                'send_cost' => 'required|numeric|min:1',
            ]);
            //接受数据
            $data = $request->post();
            //如果没有上传图片就不改图片
            if ($data['shop_img']==null){
                unset($data['shop_img']);
            }
            //更新数据
            if ($shop->update($data)) {

                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('admin.shop.index');
            }


        }
        //显示视图
        return view('admin.shop.edit', compact('shopcates','users','shop'));



    }

    //删除店铺
    public function del($id){
        $row =Shop::find($id);

        if ($row->delete()) {
            //提示
            session()->flash("danger","删除成功");
            //跳转视图
            return redirect()->route('admin.shop.index');
        }


    }

    //店铺审核
    public function status($id){
        //通过店铺id找到用户
        $shop=Shop::findOrFail($id);
        $user = User::findOrFail($shop->user_id);
        //找到shop
        $shop = Shop::find($id);
        $shop->status =1;
        if ($shop->save()) {

            $content = '恭喜店铺审核成功';
            $to = $user->email;//发邮件个用户
            $subject = '店铺审核';
            Mail::send(
                'admin.email.test',
                compact("content"),
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );


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

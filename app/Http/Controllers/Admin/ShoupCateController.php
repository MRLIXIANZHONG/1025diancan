<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShoupCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ShoupCateController extends BaseController
{
    //显示所有分类
    public function index(){
        //显示所有数据
        $shopcates = ShoupCategory::all();
        return view('admin.shopcate.index',compact('shopcates'));
    }
    //添加分类
    public function add(Request $request){
        //post提交
        if($request->isMethod('post')){
            //验证数据
            $this->validate($request,[
               'name'=>'required|unique:shoup_categories',
               'img'=>'required',
            ]);
            //接受数据
            $data = $request->post();
            //添加数据
            if (ShoupCategory::create($data)) {
                //提示
                session()->flash('success','添加成功');
                //跳转
                return redirect()->route('shopcate.index');
            }
        }
        //显示视图
        return view('admin.shopcate.add');
    }
    //编辑分类
    public function edit(Request $request,$id){

        $shopcate = ShoupCategory::find($id);
        //post提交
        if($request->isMethod('post')){

            //验证数据
            $this->validate($request,[
               'name'=>[
                   'required',
                   Rule::unique('shoup_categories')->ignore($shopcate->id),
               ],
            ]);
            //接收值
            $data = $request->post();
            //如果没有上传图片就不更改图片
            if ($data['img']==null){
                unset($data['img']);
            }
            //更改数据
            if ($shopcate->update($data)) {
                //提示
                session()->flash("danger","编辑成功");
                //跳转视图
                return redirect()->route('shopcate.index');
            }
        }
        //显示视图
        return view('admin.shopcate.edit',compact('shopcate'));

    }
    //删除分类
    public function del($id){

        $row =ShoupCategory::find($id);
        $row->delete();
        //提示
        session()->flash("danger","删除成功");
        //跳转视图
        return redirect()->route('shopcate.index');
    }
    //上线
    public function shang($id){
        $shopcate = ShoupCategory::find($id);
        $shopcate->status=1;
        $shopcate->save();
        return back()->with('success','上线设置成功');
    }
    //下线
    public function xia($id){
        $shopcate = ShoupCategory::find($id);
        $shopcate->status=0;
        $shopcate->save();
        return back()->with('success','下线设置成功');
    }




}

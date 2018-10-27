<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends BaseController
{
    //显示当前用户菜品分类列表
    public function index(){
        $id=Auth::user()->shop->id;
        //得到所有分类
       $menucates= MenuCategory::where('shop_id',$id)->paginate(10);
//       dd($menucates);
        //显示视图
        return view('shop.menucate.index',compact('menucates'));
    }
    //添加分类
    public function add(Request $request){

        //post提交
        if ($request->isMethod('post')){
            //验证数据
           $data= $this->validate($request,[
               'name'=>'required',
               'type_accumulation'=>'required',
                'description'=>'required',
            ]);
           //找到当前店铺
           $data['shop_id']=Auth::user()->shop->id;
          //添加数据
            if (MenuCategory::create($data)) {
                //提示
                session()->flash('success','添加成功');
                return redirect()->route('menucate.index');
            }
        }
        //显示视图
        return view('shop.menucate.add');
    }
    //编辑分类
    public function edit(Request $request,$id){
        //找到一条数据
        $menucate = MenuCategory::find($id);
        //post提交
        if ($request->isMethod('post')){
            //验证数据
            $data= $this->validate($request,[
                'name'=>'required',
                'type_accumulation'=>'required',
                'description'=>'required',
            ]);
            //编辑
            if ($menucate->update($data)) {
                //提示
                session()->flash('success','编辑成功');
                return redirect()->route('menucate.index');
            }
        }
        //显示视图
        return view('shop.menucate.edit',compact('menucate'));
    }
    //删除分类
    public function del($id){

        //有菜品的不能删除
       $menu= Menu::where('category_id',$id)->get();
       if(count($menu)){
            return back()->with('danger','该分类下包含菜品');
       }else{
            $menucate = MenuCategory::find($id);
           if ($menucate->delete()) {
               session()->flash('success','删除成功');
               return redirect()->route('menucate.index');
           }

       }


    }

    //设置默认菜品分类
    public function moren($id){
    //dd(MenuCategory::where('is_selected','0')->get());
        DB::table('menu_categories')->update(['is_selected'=>0]);
        DB::table('menu_categories')->where('id',$id)->update(['is_selected'=>1]);
        return back()->with('success','设置成功');

    }
}

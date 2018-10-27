<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
    //显示所有菜品
    public function index(Request $request){

        //显示当前商铺的菜品
       $id= Auth::user()->shop->id;

        //搜索条件回显
        $url = $request->post();
        //搜索分类
        $menucates = MenuCategory::all();
        //显示当前用户菜品
        $menus = Menu::orderBy('id')->where('shop_id',$id);
       //接受搜索条件
        $cate_id=$request->get('cate_id');
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $keyword =$request->get('keyword');

        //判断条件
        if ($cate_id!=null){
            $menus=$menus->where('category_id',$cate_id);
        }
        if ($minPrice!=null){
            $menus=$menus->where('goods_price','>=',$minPrice);
        }
        if ($maxPrice!=null){
            $menus = $menus->where('goods_price','<=',$maxPrice);
        }
        if ($keyword!=null){
            $menus = $menus->where('goods_name','like',"%{$keyword}%");
        }
        //设置分页显示
        $menus=$menus->paginate(10);
        return view('shop.menu.index',compact('menus','menucates','url'));
    }
    //添加菜品
    public function add(Request $request){
        //找到所有分类
        $menucates =MenuCategory::all();
        //得到当前用户信息
        $name = Auth::user()->name;
        //post提交
        if ($request->isMethod('post')){

            //数据验证
            $this->validate($request,[
                'goods_name'=>'required',
                'category_id'=>'required',
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
                'goods_img'=>'required|image',
            ]);
            //接受数据
            $data = $request->post();
            $data['shop_id']=Auth::user()->shop->id;
            //接受图片
            $data['goods_img']=$request->file('goods_img')->store('shop/menu/'.$name,'image');
            //添加数据
            if (Menu::create($data)) {
                //提示
                session()->flash('success','添加成功');
                return redirect()->route('menu.index');
            }

        }
        //显示视图
        return view('shop.menu.add',compact('menucates'));
    }
    //编辑菜品
    public function edit(Request $request,$id){
        //得到一条数据
        $menu = Menu::find($id);
        //得到菜品分类
        $menucates = MenuCategory::all();
        //post提交
        if ($request->isMethod('post')){

            //数据验证
            $this->validate($request,[
                'goods_name'=>'required',
                'category_id'=>'required',
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
                'goods_img'=>'image',
            ]);
            //得到当前用户信息
            $name = Auth::user()->name;
            //接受数据
            $data =$request->post();
            //判断是否修改了图片
            $img =$request->file('goods_img');
           if($img!=null){
               $data['goods_img']=$request->file('goods_img')->store('shop/menu/'.$name,'image');
               //删除原图片
               @unlink($request->post('oldp'));
           }
           //编辑数据
            if ($menu->update($data)) {
                //提示
                session()->flash('success','编辑成功');
                return redirect()->route('menu.index');
            }
        }
        //显示视图
        return view('shop.menu.edit',compact('menu','menucates'));
    }
    //删除菜品
    public function del($id){

        //找到菜品
        $menu = Menu::find($id);
        $photo = $menu->goods_img;
        if ($menu->delete()) {
            //删除原图片
            //删除原图片
            @unlink($photo);
            //提示
            session()->flash('danger','编辑成功');
            return redirect()->route('menu.index');

        }
    }

    //下架菜品
    public function xiajia($id){
        $menu = Menu::find($id);
        $menu->status=0;
        $menu->save();
        return back()->with('warning','下架成功');
    }
    //上架菜品
    public function shangjia($id){
        $menu = Menu::find($id);
        $menu->status=1;
        $menu->save();
        return back()->with('warning','上架成功');
    }

}

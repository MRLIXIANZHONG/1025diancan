<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    //显示活动列表
    public function index(Request $request){
        //显示所有活动
        $activity = Activity::orderBy('id');
        //接受当前值
        $cate = $request->get('cate_id');
        //得到当前时间的时间搓
        $date =strtotime(date('Y-m-d h:i:s'));
        switch ($cate){
            //未开始
            case 1:
                $activity =$activity->where('start_time','>=',$date);
                break;
            //进行中
            case 2:
                $activity =$activity->where('start_time','<',$date)->where('end_time','>',$date);
                break;
            //已结束
            case 3:
                $activity =$activity->where('end_time','<=',$date);
                break;
        }
        $activitys=$activity->paginate(10);
        $url = ['cate_id'=>$request->get('cate_id')];

        return view('admin.activity.index',compact('activitys','url'));
    }
    //添加活动
    public function add(Request $request){

        //post提交
        if ($request->isMethod('post')){
           //验证数据
           $data= $this->validate($request,[
               'title'=>'required',
                'content'=>'required',
                'start_time'=>'required|date|after_or_equal:today',
                'end_time'=>'required|date|after_or_equal:start_time',
            ]);
           //把时间日期型转换成时间搓
           $data['start_time']=strtotime($data['start_time']);
           $data['end_time']=strtotime( $data['end_time']);
//            添加活动
            if (Activity::create($data)) {
                //提示
                session()->flash('success','活动添加成功');
                return redirect()->route('admin.activity.index');
            }
        }
        //显示视图
        return view('admin.activity.add');
    }
    //编辑活动
    public function edit(Request $request,$id){
        $activity=Activity::find($id);
        //为了对时间日期型数据回显，做处理加T
        $activity->start_time=str_replace(" ",'T',date('Y-m-d H:i:s',$activity->start_time));
        $activity->end_time=str_replace(" ",'T',date('Y-m-d H:i:s',$activity->end_time));
        //dd($activity);

        //post提交
        if ($request->isMethod('post')){

            //数据验证
            $data= $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required|date|after_or_equal:today',
                'end_time'=>'required|date|after_or_equal:start_time',
            ]);

            //把时间日期型改成时间搓
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            //更改数据
            if ($activity->update($data)) {
                //提示
                session()->flash('success','活动编辑成功');
                return redirect()->route('admin.activity.index');
            }

        }
        //显示视图
        return view('admin.activity.edit',compact('activity'));
    }
    //删除活动
    public function del($id){
        $ac =Activity::find($id);
        if ($ac->delete()) {
            //提示
            session()->flash('danger','活动删除成功');
            return redirect()->route('admin.activity.index');
        }

    }
}

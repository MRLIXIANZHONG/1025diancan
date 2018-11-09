<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    //添加抽奖奖品
    public function add(Request $request,$id){

        //通过id查看活动，如果活动已经开奖，不能添加奖品
        $event = Event::find($id);

        if ($event->is_prize!=0){
            return back()->with('danger','已经开奖不能添加奖品');
        }


        //得到所有活动
        $events = Event::all();
        if ($request->isMethod('post')){
            //数据验证
           $data= $this->validate($request,[
                'name'=>'required',
                'description'=>'required'
            ]);
           $data['event_id']=$id;
           //添加数据
            EventPrize::create($data);
            return redirect()->route('admin.eventPrize.index',['id'=>$id])->with('success','添加成功');

        }
        //显示视图
        return view('admin.eventPrize.adds',compact('events'));

    }
    //编辑抽奖奖品
    public function edit(Request $request,$id){



        $eventP =EventPrize::find($id);
        $event_id=$eventP->event_id;
        //通过id查看活动，如果活动已经开奖，不能编辑奖品
        $event = Event::find($event_id);

        if ($event->is_prize!=0){
            return back()->with('danger','已经开奖不能添加奖品');
        }

        if ($request->isMethod('post')){
            //数据验证
           $data= $this->validate($request,[
               'name'=>'required',
               'description'=>'required'
            ]);


            $eventP->update($data);

            return redirect()->route('admin.eventPrize.index',$event_id)->with('success','编辑成功');
        }
        return view('admin.eventPrize.edit',compact('eventP'));


    }
    //删除抽奖奖品
    public function del(Request $request,$id){

        $eventP =EventPrize::find($id);
        $event_id=$eventP->event_id;
        //通过id查看活动，如果活动已经开奖，不能添加奖品
        $event = Event::find($event_id);

        if ($event->is_prize!=0){
            return back()->with('danger','已经开奖不能删除奖品');
        }
        $eventP->delete();
        return redirect()->route('admin.eventPrize.index',$event_id)->with('danger','删除成功');



    }
    //奖品列表
    public function index(Request $request,$id){
        //查询当前活动奖品
        $eventPrizes = EventPrize::where('event_id',$id)->paginate(10);

        return view('admin.eventPrize.index',compact('eventPrizes'));


    }


}

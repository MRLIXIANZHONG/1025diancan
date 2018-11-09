<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{
    //添加抽奖活动
    public function add(Request $request){

        if ($request->isMethod('post')){
            //数据验证
           $data= $this->validate($request,[
               'title'=>'required',
               'content'=>'required',
                'start_time'=>'required|after_or_equal:today',
                'end_time'=>'required|after_or_equal:start_time',
                'prize_time'=>'required|after_or_equal:end_time',
                'num'=>'required|numeric|min:1'
            ]);

           //时间要转换成时间搓
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);


//           添加抽奖
            $event = Event::create($data);

            //把活动限制人数存入在redis 集合
            Redis::set('event_num:'.$event->id,$data['num']);

            return redirect()->route('admin.event.index')->with('success','抽奖活动添加成功');

        }
        //显示视图
        return view('admin.event.add');

    }
    //删除抽奖活动
    public function del(Request $request,$id){



    }
    //显示抽奖活动列表
    public function index(Request $request){

        $events = Event::paginate(7);

        return view('admin.event.index',compact('events'));

    }
    //编辑抽奖活动
    public function edit(Request $request,$id){
        $event = Event::find($id);

        //判断是否开奖如果开奖就不能编辑
        if ($event->is_prize!=0){
            return back()->with('danger','开奖的活动不能编辑');
        }

        if ($request->isMethod('post')){

            //数据验证
            $data= $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required|after_or_equal:today',
                'end_time'=>'required|after_or_equal:start_time',
                'prize_time'=>'required|after_or_equal:end_time',
                'num'=>'required|numeric|min:1'
            ]);
            //时间要转换成时间搓
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);

            //编辑
            $event->update($data);
            return redirect()->route('admin.event.index')->with('success','编辑成功');

        }
        //把时间搓转换成时间
        $event->start_time=str_replace(" ","T",date( "Y-m-d H:i:s",$event->start_time));
        $event->end_time=str_replace(' ','T',date("Y-m-d H:i:s", $event->end_time));
        $event->prize_time=str_replace(' ','T',date( "Y-m-d H:i:s",$event->prize_time));

        return view('admin.event.edit',compact('event'));


    }

    //开奖
    public function on(Request $request,$id){

        //如果没有奖品，不让开奖
       $evetn_prize = EventPrize::where('event_id',$id)->first();

       if(!count($evetn_prize)){
           return back()->with('danger','没有奖品，不能开奖');
       }


        //取出所有报名的会员
        $users = EventUser::where('event_id',$id)->pluck('user_id')->toArray();

        //打乱数组
        shuffle($users);

       //判断奖品有多少个
        $eventsPrizes = EventPrize::where('event_id',$id)->get();

        foreach ($eventsPrizes as $eventsPrize){

            //随机取出一个会员
            $k=array_rand($users);

            //得到会员的邮箱
            $us = User::where('id',$users[$k])->first();
            $email=$us->email;
            //给用户发邮件
            $content="全球最大交易网";
            $to = $email;//收件人
            $subject = ' 中奖通知';//邮件标题
            Mail::send(
                'admin.email.test',//视图
                compact("content"),//传递给视图的参数
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );
            //邮件发送完成

            //写入数据库
            $eventsPrize->user_id=$users[$k];
            $eventsPrize->save();
            //删除取出的会员
            unset($users[$k]);

        }
        //并更改活动状态
        $event = Event::find($id);
        $event->is_prize = 1;
        $event->save();
        return back()->with('success','抽奖完成');
    }

}

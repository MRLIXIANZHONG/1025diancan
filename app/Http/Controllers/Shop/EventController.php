<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{
    //抽奖活动列表
    public function index(Request $request){

        $events = Event::paginate(10);

        return view('shop.event.index',compact('events'));
    }

    //报名抽奖
    public function luck(Request $request,$id){

        //1.取出报名限制人数
        $event_num = Redis::get('event_num:'.$id);

        //2取出报名人数数量
        $users=Redis::scard("event:".$id);


        if ($event_num >= $users){

            //3. 把当前报名的人的ID 存到 Redis中  存什么类型 格式 event:3
            Redis::sadd("event:".$id,Auth::id());

            $data =[
                'user_id'=>Auth::id(),
                'event_id'=>$id,
            ];
            EventUser::create($data);
            return back()->with('info','报名成功');
        }else{
            return back()->with('danger','人数已满，下次再来');
        }


    }

    //查看抽奖结果
    public function select(Request $request,$id){

        //查询当前活动奖品
        $eventPrizes = EventPrize::where('event_id',$id)->paginate(10);

        return view('shop.event.result',compact('eventPrizes'));



    }
}

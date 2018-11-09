<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventUserController extends BaseController
{
    //查看报名信息
    public function index(Request $request,$id){
        $eventUsers=EventUser::where('event_id',$id)->paginate(10);

        return view('admin.eventUser.index',compact('eventUsers'));
    }



}

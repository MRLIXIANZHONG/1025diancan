<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    //显示活动
    public function index(){


        //得到当前时间的时间搓
        $date = strtotime(date('Y-m-d H:i:s'));

        $activitys = Activity::where('end_time','>',$date)->paginate(10);
        //显示视图
        return view('shop.activity.index',compact('activitys'));


    }
}

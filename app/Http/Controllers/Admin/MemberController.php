<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    //会员列表
    public function index(){
        //得到所有会员
        $members = Member::paginate(10);

        //显示视图
        return view('admin.member.index',compact('members'));



    }
}

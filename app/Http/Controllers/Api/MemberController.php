<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    //会员注册
    public function reg(Request $request)
    {
        //创建收到验证
        $values = $request->post();
        $validator = Validator::make($values, [
            'username' => 'required|unique:members',
            'tel' => 'required|regex:/^1[34578]\d{9}$/|unique:members',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            //错误提示
            $errors = $validator->errors();

            $data = [
                "status" => "false",
                "message" => $errors,
            ];

        } else {
            //判断验证码是否正确
            if ($values['sms'] != Redis::get('tel_' . $values['tel'])) {
                $data = [
                    "status" => "false",
                    "message" => '验证码不对'
                ];
            } else {
                //把数据写入数据库
                //密码加密
                $values['password'] = bcrypt($values['password']);
                Member::create($values);
                //状态成功
                $data = [
                    "status" => "true",
                    "message" => '注册成功'
                ];
            }

        }

        return $data;


    }

    //验证码短信验证
    public function sms(Request $request)
    {
        $tel = $request->get('tel');

        //产生一个随机的验证码
        $num = mt_rand(100000, 999999);

        //存在redis里面
        Redis::setex('tel_' . $tel, 60 * 5, $num);


        //调用短信发送
        $config = [
            'access_key' => 'LTAI2zMh1fLKargo', //键
            'access_secret' => 'Quj1ODS5Kh33f9M57Yjxk2sN2yKKRB',//密匙
            'sign_name' => '个人学习技术交流',//阿里云签名
        ];

        $sms = new AliSms();
        //phone number 电话号码
        //tempplate code 模板名称
        //name 模板键名 跟模板保持一致
        //value in your template 显示在模板上的值,发送给手机的值
//        $response = $sms->sendSms($tel, 'SMS_149422356', ['code'=> $num], $config);
//
//        if($response->Code=="OK"){
//            $data = [
//                "status" => true,
//                "message" => "获取短信验证码成功" . $num
//            ];
//        }else{
//            $data = [
//                "status" => false,
//                "message" => $response->Message,
//            ];
//        }

        $data = [
            "status" => true,
            "message" => "获取短信验证码成功"
        ];
        return $data;

    }

    //会员登录
    public function login(Request $request)
    {
        //接受数据
        $values['password'] = $request->post('password');
        $values['username'] = $request->post('name');
        //验证数据
        $validator = Validator::make($values, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            //错误提示
            $errors = $validator->errors();
            $data = [
                "status" => "false",
                "message" => $errors,

            ];
        } else {
            //判断用户名密码是否正确
            $user = Member::where('username',$values['username'])->first();

            if (count($user) && Hash::check($values['password'],$user->password)) {
                $data = [
                    "status" => "true",
                    "message" => "登录成功",
                    "user_id" => $user->id,
                    "username" => $user->username
                ];
            } else {
                $data = [
                    "status" => "false",
                    "message" => "用户名密码错误",

                ];
            }
        }
        return $data;

    }

    //重置密码
    public function editPassword(Request $request)
    {

        //接受数据
        $values = $request->post();
        //验证数据
        //电话号码必须跟注册时一致
        $user = Member::where('tel', $values['tel'])->first();
        if (count($user)) {
            //查看验证码是否正确
            $num = Redis::get('tel_' . $values['tel']);
            if ($values['sms'] != $num) {
                $data = [
                    "status" => "false",
                    "message" => "验证码错误"
                ];
            } else {
                //重置密码
                $user->password = bcrypt($values['password']);
                $user->save();
                $data = [
                    "status" => "true",
                    "message" => "重置成功"
                ];
            }


        } else {
            $data = [
                "status" => "false",
                "message" => "电话号码不存在"
            ];

        }

        return $data;
    }

    //修改密码
    public function setPassword(Request $request)
    {

        //接受数据
        $values = $request->post();
        //判断旧密码是否正确
        $user = Member::find($values['id']);
        if (Hash::check($values['oldPassword'], $user->password)) {
            //修改密码
            $user->password = bcrypt($values['newPassword']);
            $user->save();
            $data = [
                "status" => "true",
                "message" => "修改成功"
            ];
        }else{

            $data = [
                "status" => "false",
                "message" => "旧密码不对"
            ];

        }

        return $data;

    }

    //查询个人资料
    public function userDetail(Request $request){

        return Member::where('id',$request->get('user_id'))->first();

    }


}

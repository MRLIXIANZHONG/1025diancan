<?php

namespace App\Http\Controllers\Api;

use App\Models\MemberAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MemberAddressController extends Controller
{
    //添加地址
    public function add(Request $request)
    {
        //接受数据
        $value = $request->post();
        //数据验证
        $validator = Validator::make($value, [
            'name' => 'required',
            'tel' => 'required|regex:/^1[345678][0-9]{9}$/',
            'user_id' => 'required',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->first();
            return [
                "status" => "false",
                "message" => $errors
            ];
        } else {
            //添加数据
            MemberAddress::create($value);
            return [
                "status" => "true",
                "message" => "添加成功"
            ];

        }

    }

    //地址列表
    public function addressList(Request $request)
    {

        //接受id
        $user_id = $request->get('user_id');
        //查找当前会员的所有地址
        $address = MemberAddress::where('user_id', $user_id)->get();
        //判断当前是否有有地址
        if (count($address)) {
            //遍历地址
            $data = [];
            foreach ($address as $addres) {
                //向数组尾部插入数据
                array_push($data, $addres);

            }
            return $data;
        } else {
            return [
                'status' => 'false',
                'massag' => '没有地址',
            ];
        }

    }

    //显示一个地址,修改回显
    public function address(Request $request)
    {

        //接受地址id
        $id = $request->get('id');
        //查找当前地址
        return MemberAddress::where('id', $id)->first();

    }

    //修改地址
    public function addressEdit(Request $request)
    {
        //接受id
        $id = $request->post('id');
        //查找地址
        $add = MemberAddress::where('id', $id)->first();

        //接受值
        $value = $request->post();
        //验证数据
        $validator = Validator::make($value, [
            'name' => 'required',
            'tel' => 'required|regex:/^1[345678][0-9]{9}$/',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return [
                "status" => "false",
                "message" => $error,
            ];
        }else{
            //修改数据
            $add->update($value);
            return [
                "status" => "true",
                "message" => '修改成功',
            ];
        }


    }



}

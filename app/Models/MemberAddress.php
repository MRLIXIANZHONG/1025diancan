<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MemberAddress
 *
 * @property int $id
 * @property int $user_id 会员id
 * @property string $name 姓名
 * @property string $tel 电话
 * @property string $provence 省
 * @property string $city 市
 * @property string $area 区
 * @property string $detail_address 详细信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status 默认地址 1默认地址
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereDetailAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereProvence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberAddress whereUserId($value)
 * @mixin \Eloquent
 */
class MemberAddress extends Model
{
    //允许更改的字段
    protected $fillable=[
      'name','user_id','tel','provence','city','area','detail_address',
    ];
}

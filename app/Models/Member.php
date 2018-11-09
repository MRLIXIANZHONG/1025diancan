<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $username 会员名
 * @property string $tel 电话
 * @property string $password 密码
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $money 金钱
 * @property int $jifen 积分
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereJifen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUsername($value)
 * @mixin \Eloquent
 */
class Member extends Authenticatable
{
    //允许更改的字段
    protected $fillable=[
      'username','tel','password'
    ];
}

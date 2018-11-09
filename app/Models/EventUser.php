<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //允许更改的字段
    protected $fillable=[
      'user_id','event_id'
    ];

    //跟商家user表建立多对多关系
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //跟活动建立多对多关系
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}

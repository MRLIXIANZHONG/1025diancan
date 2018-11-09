<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //允许更改的字段
    protected $fillable=[
      'event_id','name','description','user_id'
    ];

    //跟商家user表建立多对多关系
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //跟活动表建立多对多关系
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}

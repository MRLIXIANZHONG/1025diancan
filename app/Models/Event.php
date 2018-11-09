<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //允许更改的字段
    protected $fillable=[
      'title','content','start_time','end_time','prize_time','num','is_prize'
    ];
}

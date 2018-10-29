<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //允许更改的字段
    protected $fillable=[
        'title','content','start_time','end_time',
    ];
}

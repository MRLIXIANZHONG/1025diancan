<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoupCategory extends Model
{
    //允许更改的字段
    protected $fillable=[
        'name','img','status'
    ];
}

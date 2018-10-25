<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //允许更改的字段
    protected $fillable=[
        'name','password','email'
    ];


}

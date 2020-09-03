<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
// 软删除类
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends AuthUser
{
    //
    use SoftDeletes;

    protected $rememberTokenName = '';

    // 软删除标识字段
    protected $dates = ['deleted_at'];

    protected $fillable = ['username', 'truename', 'password','email','phone','sex', 'last_ip'];


    protected $hidden = ['password'];
}

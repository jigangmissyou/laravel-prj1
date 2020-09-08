<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
// 软删除类
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Btn;

class User extends AuthUser
{
    //
    use SoftDeletes, Btn;

    protected $rememberTokenName = '';

    // 软删除标识字段
    protected $dates = ['deleted_at'];

    protected $guarded = [];


//    protected $fillable = ['username', 'truename', 'password','email','phone','sex', 'last_ip', 'role_id'];


    protected $hidden = ['password'];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }
}

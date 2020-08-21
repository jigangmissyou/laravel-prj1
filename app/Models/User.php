<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;


class User extends AuthUser
{
    //
    protected $hidden = ['password'];
}

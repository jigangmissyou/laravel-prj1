<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Observers\NoticeObserver;


class Notice extends Base
{
    //模型类的初始化方法， 方法中最早执行的
    protected static function boot()
    {
        parent::boot();
        self::observe(NoticeObserver::class);

    }

//    protected $table = 'Notices';
}

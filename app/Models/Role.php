<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Base
{
    //
    public function nodes(){
        // 1 关联模型
        // 2 中间表的名称
        // 3 本模型对应的外键id
        // 4 关联模型对应的外键id
        return $this->belongsToMany(Node::class, 'role_node','role_id', 'node_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Node extends Base
{
    //

    public function getAllList(){
        $data = self::get()->toArray();
        return $this->treeLevel($data);

    }

    public function treeData($allowNode){

        $query = Node::where('is_menu', '1');
        if(is_array($allowNode)){
            $query->whereIn('id', array_keys($allowNode));
        }
        $menuData = $query->get()->toArray();

        return $this->subTree($menuData);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    /**
     * 数组的合并，并加上html标识前缀
     * @param array $data
     * @param int $pid
     * @param string $html
     * @param int $level
     * @return array
     */
    public function treeLevel( $data = [],  $pid = 0,  $html = '--',  $level = 0) {
        static $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                // 重复一个字符多少次
                $val['html'] = str_repeat($html, $level * 2);
                $val['level'] = $level + 1;
                $arr[] = $val;
                $this->treeLevel($data, $val['id'], $html, $val['level']);
            }
        }
        return $arr;
    }

    public function subTree($data, $pid = 0){
        $arr = [];
        foreach ($data as $val){
            if($pid == $val['pid']){
                $val['sub'] = $this->subTree($data, $val['id']);
                $arr[] = $val;
            }
        }
        return $arr;
    }
}

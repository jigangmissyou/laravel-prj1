<?php


namespace App\Models\Traits;


trait Btn
{
    /**
     * @param string $route
     * @return string
     */
    public function assignRightBtn(string $route){
        if(auth()->user()->username != config('rbac.super') && !in_array($route, request()->auths)){
            return '';
        }
        return '<a href="'.route($route,$this).'" class="label label-secondary radius">分配权限</a>';
    }

    public function delBtn(string $route){

    }

}
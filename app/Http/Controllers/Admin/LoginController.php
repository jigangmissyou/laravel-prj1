<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //


    function login(Request $request){

        $this->validate($request, ['username'=>'required', 'password'=>'required']);
        $post = $request->only(['username', 'password']);
        $result = Auth::attempt(['username' => $post['username'], 'password' => $post['password']]);
        if($result){
            if($post['username'] != config('rbac.super')){
                $userModel = auth()->user();
                $roleModel = $userModel->role;
                $nodeArr = $roleModel->nodes()->pluck('route_name','id')->toArray();
//                dd($nodeArr);
                session(['admin.auth' => $nodeArr]);
            } else {
                session(['admin.auth' => true]);
            }
            return redirect(route('admin.index'));
        }
        //将验证失败的信息写到errors里面
        return redirect(route('admin.login'))->withErrors(['error'=>'登录失败']);
    }

    function index(){
        return view('admin.login.login');
    }

}

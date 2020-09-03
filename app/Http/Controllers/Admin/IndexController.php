<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    function index(){
        return view('admin.index.index');
    }

    function welcome(){
        return view('admin.index.welcome');
    }

    function logout(){
        Auth::logout();
        return redirect(route('admin.login'))->with('success','请重新登录');
    }
}

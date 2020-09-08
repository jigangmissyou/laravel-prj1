<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    function index(){
        $auth = session('admin.auth');
        $model  = new Node();
        $menuData = $model->treeData($auth);
        return view('admin.index.index', compact('menuData'));
    }

    function welcome(){
        return view('admin.index.welcome');
    }

    function logout(){
        Auth::logout();
        return redirect(route('admin.login'))->with('success','请重新登录');
    }
}

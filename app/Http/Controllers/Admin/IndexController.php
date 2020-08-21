<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    function index(){
        return view('admin.index.index');
    }

    function welcome(){
        return view('admin.index.welcome');
    }
}

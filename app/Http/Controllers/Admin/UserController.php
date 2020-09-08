<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Integer;

class UserController extends Controller
{
    //
    function index(){
       $data =  User::paginate(10);
       return view('admin.user.index', compact('data'));
    }

    function create(){
        return view('admin.user.create');
    }

    function store(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'truename' => 'required',
            // 两次密码是否一致的验证
            'password' => 'required|confirmed',
            // 自定义验证规则
        ]);
        $post = $request->except(['_token', 'password_confirmation']);
        $post['password'] = bcrypt($post['password']);
        User::create($post);
        return redirect(route('admin.user.index'))->with('success','添加用户成功');

    }

    function edit(int $id){
        $userModel = User::find($id);
        return view('admin.user.edit', compact('userModel'));
    }

    function save(Request $request, int $id){
        $userModel = User::find($id);
        $bool = Hash::check($request['password'], $userModel->password);
        if($bool){
            $post = $request->except(['_token', 'password']);
            $userModel->update($post);
            return redirect(route('admin.user.index'))->with('success', '修改成功');
        }else{
            return redirect(route('admin.user.index'))->withErrors('密码不正确');
        }

    }

    function del(int $id){
        User::find($id)->delete();
        return ['status' => 0, 'msg' => '删除成功'];
    }

    function delAll(Request $request){
        $id = $request->get('id');
        User::destroy($id);
        return ['status'=>0, 'msg'=>'全部删除成功'];
    }

    //上海泗泾资产经营有限公司
    //上海银行泗泾支行
    //31918503003008389
    // 706 郭振芳

    function role(Request $request, User $user){
        if ($request->isMethod('post')){
            $this->validate($request,
                ['role_id'=>'required']
            );
//            dd($post);

            $post = $request->except(['_token']);

            $user->update($post);

            return redirect(route('admin.user.index'));
        }

        $roleAll = Role::all();
        return view('admin.user.role',compact('user','roleAll'));
    }
}

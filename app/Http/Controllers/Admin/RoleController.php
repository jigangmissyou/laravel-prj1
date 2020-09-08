<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $name = $request->get('name','');
        $data = Role::when($name, function($query) use ($name){
            $query->where('name','like',"%{$name}%");
        })->paginate(20);
        return view('admin.role.index',compact('data', 'name'));
    }

    public function node(Role $role) {
        //dump($role->nodes->toArray());
        //dump($role->nodes()->pluck('name','id')->toArray());
        // 读取出所有的权限
        $nodeAll = (new Node())->getAllList();
//        $roleModel = new Role();
//        $ret = $roleModel::find(1);
//        dd($ret->nodes->toArray());
        // 读取当前角色所拥有的权限
        $nodes = $role->nodes()->pluck('id')->toArray();

        return view('admin.role.node',compact('role','nodeAll','nodes'));
    }

    public function nodeSave(Request $request, Role $role){
        //关联模型的数据同步
        $role->nodes()->sync($request->get('node'));
        return redirect(route('admin.role.node',$role));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $this->validate($request, [
                'name'=>'required|unique:roles,name'
            ]);

        }catch (\Exception $e){
            return ['status'=>1000,'msg'=>'验证不通过'];
        }
        Role::create($request->only('name'));
        return ['status'=>0, 'msg'=>'添加角色成功'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = Role::find($id);
        return view('admin.role.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
          $this->validate($request, [
              //排除需要修改的id的name字段的值
              'name'=>'required|unique:roles,name,'.$id.',id'
          ]);
        }catch (\Exception $e){
            return ['status'=> 1000, 'msg'=>'验证不通过'];
        }
        $name = $request->only(['name']);
        Role::where([['id','=',$id]])->update($name);
        return ['status'=>0, 'msg'=>'修改用户成功'];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

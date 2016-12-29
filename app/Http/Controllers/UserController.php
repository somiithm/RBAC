<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all(['id','name','email','created_at','updated_at']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|max:15',
            'roles' => 'array'
        ]);

        $roleIds = [];
        if($request->has('roles')){
            $this->validateRoles($request);
            $roleIds = $request->get('roles');
        }

        $data = $request->all();
        $keys = ['name','email','password'];
        $passData = [];
        foreach($keys as $key){
            $passData[$key] = $data[$key];
        }
        $passData['password'] = bcrypt($passData['password']);

        $user = User::create($passData);
        $user->roles()->sync($roleIds);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with('roles')->where('id',$id)->get();
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'roles' => 'required|array',
        ])                ;
        $this->validateRoles($request);
        $user = User::find($id);
        $user->roles()->sync($request->get('roles'));
        return $this->show($user->id);
    }

    private function validateRoles(Request $request)
    {
        $roleIds = [];
        $roles = Role::whereIn('id', $request->get('roles'))->get(['id']);
        foreach ($roles as $role) {
            $roleIds[] = $role->id;
        }
        if(!empty(array_diff($request->get('roles'),$roleIds)))
            abort(400,'bad request');
    }
}

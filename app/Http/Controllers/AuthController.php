<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        try{
            $this->validate($request,[
                'username' => 'required|email',
                'password' => 'required'
            ]);
        } catch(\Exception $ex){
            return view('login',['user'=>null,'error'=>'incorrect data format or inssuficient data']);
        }

        $data = $request->all();
        if (Auth::attempt(['email' => $data['username'], 'password' => $data['password']])) {
            return redirect()->route('main');
        }
        return view('login',['user'=>null,'error'=>'invalid credentials']);
    }

    public function logout(){
        Session::flush();
        return redirect()->route('main');
    }
}

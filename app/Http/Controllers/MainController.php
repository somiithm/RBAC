<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::getRoutes()->getRoutes();
        $routes = array_filter($routes, function($e){
            $actions = $e->getAction();
            if(isset($actions['group_name']) && $actions['group_name'] == 'demo')
                return true;
            else
                return false;
        });
        return view('main',['user'=>request()->user(),'routes'=>$routes]);
    }

    public function showLoginPage(){
        Session::flush();
        return view('login',['user'=>null,'error'=>null]);
    }

    public function displayAccess(){
        return "You have access";
    }
}

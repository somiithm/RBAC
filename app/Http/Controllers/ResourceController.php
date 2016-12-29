<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::all(['name','description','id','created_at','updated_at']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Resource::find($id);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){
       $this->validate($request,[
           'name' => 'required',
           'description'=>'required'
       ]);

        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');

        return Resource::create($data);
    }
}

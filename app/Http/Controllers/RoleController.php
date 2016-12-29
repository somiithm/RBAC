<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all(['id', 'name', 'description', 'created_at', 'updated_at']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'resources' => 'array', //resource ids
            'actions' => 'array'
        ]);

        if ($request->has('actions'))
            foreach ($request->get('actions') as $action) {
                if (!is_array($action))
                    abort(400, 'bad request');
            }

        $ids = Resource::whereIn('id', $request->get('resources'))->get(['id']);
        $resourceIds = [];
        foreach($ids as $id){
            $resourceIds[] = $id->id;
        }

        if ($request->has('resources'))
            if (array_diff($resourceIds, $request->get('resources')))
                abort(400, 'bad request');

        $role = Role::create(['name' => $request->get('name'), 'description' => $request->get('description')]);
        return $this->attachResources($request, $resourceIds, $role);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Role::with('resources')->where('id',$id)->get();
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
        $this->validate($request, [
            'resources' => 'required|array', //resource ids
            'actions' => 'required|array'
        ]);

        $role = Role::find($id);
        return $this->attachResources($request,$request->get('resources'),$role);
    }

    /**
     * @param Request $request
     * @param $resourceIds
     * @param $role
     * @return mixed
     */
    private function attachResources(Request $request, array $resourceIds, Role $role)
    {
        $syncData = [];
        $actions = $request->get('actions');
        for ($i = 0; $i < count($resourceIds); $i++)
            $syncData[$resourceIds[$i]] = ['actions' => json_encode($actions[$i])];
        $role->resources()->sync($syncData);
        return Role::with('resources')->where('id',$role->id)->get();
    }
}

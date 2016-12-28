<?php

namespace App\Http\Middleware;

use Closure;

class RoleBasedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null){
            return response("You do not have access"); //sending 200 only for demo purpose
        }
        $user = $request->user();
        $actions = $request->route()->getAction();

        if(isset($actions['resource']) &&
           isset($actions['action']) &&
            !$user->hasPermission($actions['resource'],$actions['action'])
            ){
            return response("You do not have access"); //sending 200 only for demo purpose
        }

        return $next($request);
    }
}

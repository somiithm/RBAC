<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles(){
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public  function hasPermission($resource,$action){
        $res = \DB::table('permissions')
            ->join('resources','permissions.resource_id','=','resources.id')
            ->join('roles','permissions.role_id','=','roles.id')
            ->join('user_role','user_role.role_id','=','roles.id')
            ->where('user_role.user_id','=',$this->id)
            ->where('resources.name',$resource)
            ->get(['permissions.actions as actions']);

        $actionsAllowed = array_column($res,'actions');
        $allowables = [];

        foreach($actionsAllowed as $actionAllowed){
            $allowables = array_merge($allowables,json_decode($actionAllowed));
        }

        foreach($allowables as $allowable){
            if(fnmatch($allowable,$action))
                return true;
        }

        return false;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name','description'];

    public  function users(){
        return $this->belongsToMany('App\User','user_role','role_id','user_id');
    }

    public function resources(){
        return $this->belongsToMany('App\Resource','permissions','role_id','resource_id')->withPivot('actions');
    }
}

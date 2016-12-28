<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name','description'];

    public function roles(){
        return $this->belongsToMany('App\Role','permissions','resource_id','role_id')->withPivot('actions');
    }
}

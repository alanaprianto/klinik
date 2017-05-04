<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'icon',
        'image',
        'parent_id'
    ];

    public function childs(){
        return $this->hasMany('App\Permission', 'parent_id');
    }

    public function parent(){
        return $this->belongsTo('App\Permission', 'parent_id', 'id');
    }
}

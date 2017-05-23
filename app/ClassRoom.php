<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'desc'
    ];

    public function rooms(){
        return $this->hasMany('App\Room');
    }

    public function references(){
        return $this->hasMany('App\Reference');
    }
}

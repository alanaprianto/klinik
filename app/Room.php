<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'desc',
        'type'
    ];

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function classRooms(){
        return $this->belongsToMany('App\ClassRoom', 'class_rooms_rooms', 'class_rooms_id','rooms_id');
    }

    public function beds(){
        return $this->hasMany('App\Bed');
    }
}

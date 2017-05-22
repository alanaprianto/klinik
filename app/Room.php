<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'desc',
        'type',
        'class_room_id'
    ];

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function classRoom(){
        return $this->belongsTo('App\ClassRoom', 'class_room_id', 'id');
    }

    public function beds(){
        return $this->hasMany('App\Bed');
    }
}

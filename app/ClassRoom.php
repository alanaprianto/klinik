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
        return $this->belongsToMany('App\Room', 'class_rooms_rooms', 'rooms_id', 'class_rooms_id');
    }
}

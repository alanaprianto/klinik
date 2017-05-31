<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'desc',
        'status',
        'room_id',
        'patient_id',
    ];

    public function room(){
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
}

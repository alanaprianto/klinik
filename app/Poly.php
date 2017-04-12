<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];

    public function histories(){
        return $this->hasMany('App\History');
    }

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function doctors(){
        return $this->belongsToMany('App\Staff', 'doctors_polies', 'staff_id', 'polies_id');
    }
}

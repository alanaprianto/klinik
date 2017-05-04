<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    protected $fillable = [
        'name',
        'desc',
    ];

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function doctors(){
        return $this->belongsToMany('App\Staff', 'doctors_polies', 'staff_id', 'polies_id');
    }

    public function depo(){
        return $this->hasOne('App\Depo');
    }
}

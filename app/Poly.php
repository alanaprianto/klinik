<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    protected $fillable = [
        'name'
    ];

    public function visits(){
        return $this->hasMany('App\Visit');
    }

    public function doctors(){
        return $this->belongsToMany('App\Doctor', 'polies_doctors', 'doctor_id', 'poli_id');
    }
}

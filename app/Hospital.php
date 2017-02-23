<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'website',
        'unit_state',
        'unit_number',
        'province_code',
        'province_name',
        'image_header'
    ];

    public function staffs(){
        return $this->hasMany('App\Staff');
    }

    public function patients(){
        return $this->hasMany('App\Patient');
    }
}

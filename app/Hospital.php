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
        'footer_kwitansi',
        'unit_state',
        'unit_number',
        'province_code',
        'province_name',
        'signature_sign',
        'image_header',
        'setting'
    ];

    public function staffs(){
        return $this->hasMany('App\Staff');
    }

    public function patients(){
        return $this->hasMany('App\Patient');
    }

    public function pharmacy(){
        return $this->hasOne('App\Pharmacy');
    }
}

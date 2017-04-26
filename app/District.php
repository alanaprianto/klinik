<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name',
        'code',
        'sub_code'
    ];

    public function city(){
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function subDistricts(){
        return $this->hasMany('App\SubDistrict');
    }

}

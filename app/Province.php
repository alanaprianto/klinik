<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'code',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function cities(){
        return $this->hasMany('App\City');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'code',
        'sub_code'
    ];

    public function province(){
        return $this->belongsTo('App\Province', 'province_id', 'id');
    }

    public function districts(){
        return $this->hasMany('App\District');
    }


}

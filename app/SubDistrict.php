<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $fillable = [
        'name',
        'code',
        'sub_code'
    ];

    public function district(){
        return $this->belongsTo('App\District', 'district_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function cities(){
        return $this->hasMany('App\City');
    }
}

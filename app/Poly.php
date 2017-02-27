<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];

    public function visits(){
        return $this->hasMany('App\Visit');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];
    public function settings(){
        return $this->hasMany('App\Setting');
    }
}

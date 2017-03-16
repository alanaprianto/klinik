<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];
    public function staff(){
<<<<<<< HEAD
        return $this->hasMany('App\Staff');
=======
        return $this->hasOne('App\Staff');
>>>>>>> 1927ec38e0b1e3067ed432439ce1a3e9a6a38afa
    }
}

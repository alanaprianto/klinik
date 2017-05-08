<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}

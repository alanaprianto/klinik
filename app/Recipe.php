<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'reference_id',
        'number_recipe',
        'staff_id'
    ];

    public function reference(){
        return $this->belongsTo('App\Reference', 'reference_id', 'id');
    }

    public function pharmacySellers(){
        return $this->hasMany('App\PharmacySeller');
    }

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function tuslahs(){
        return $this->hasMany('App\Tuslah');
    }

    public function buyer(){
        return $this->hasOne('App\Buyer');
    }
}
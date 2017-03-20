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
        return $this->belongsTo('App\Recipe', 'reference_id', 'id');
    }

    public function pharmacySellers(){
        return $this->hasMany('App\PharmacySeller');
    }

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
}

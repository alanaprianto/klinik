<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuslah extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'price',
        'recipe_id'
    ];

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}

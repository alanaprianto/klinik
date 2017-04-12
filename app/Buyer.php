<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'full_name',
        'gender',
        'phone_number',
        'address'
    ];

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}

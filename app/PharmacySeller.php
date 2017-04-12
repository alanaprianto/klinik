<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacySeller extends Model
{
    protected $fillable = [
        'inventory_id',
        'recipe_id',
        'amount',
        'total_payment',
        'staff_id',
        'status'
    ];

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }


}

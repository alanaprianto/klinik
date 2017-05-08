<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'amount',
        'stock_minimal',
        'stock_maximal',
        'unit',
        'stock_on_hold',
        'inventory_id'
    ];

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }
}

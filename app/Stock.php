<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'stock',
        'stock_minimal',
        'stock_maximal',
        'unit',
        'stock_on_hold',
        'depo_id',
        'price',
        'inventory_id'
    ];

    public function depo(){
        return $this->belongsTo('App\Depo', 'depo_id', 'id');
    }

    public function inventory(){
        return $this->belongsTo('App\Depo', 'inventory_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'amount',
        'price',
        'total',
        'unit'
    ];

    public function transaction(){
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }
}

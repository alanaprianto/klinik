<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'amount',
        'price'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuslah extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'price',
        'pharmacy_transaction_id'
    ];

    public function pharmacyTransaction(){
        return $this->belongsTo('App\PharmacyTransaction', 'pharmacy_transaction_id');
    }
}

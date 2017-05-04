<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyTransaction extends Model
{
    protected $fillable = [
        'amount',
        'total_payment',
        'status',
        'type',
        'discount',
        'subsidy',
        'tax',
        'staff_id',
        'pharmacy_id',
        'distributor_id'
    ];

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function pharmacy(){
        return $this->belongsTo('App\Pharmacy', 'pharmacy_id', 'id');
    }

    public function distributor(){
        return $this->belongsTo('App\Staff', 'distributor_id', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'staff_id',
        'distributor_id',
        'patient_id',
        'type',
        'amount',
        'status',
        'price',
        'from_depo_id',
        'to_depo_id',
        'other',
        'number_transaction'
    ];

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function from(){
        return $this->belongsTo('App\Depo', 'from_depo_id', 'id');
    }

    public function to(){
        return $this->belongsTo('App\Depo', 'to_depo_id', 'id');
    }

    public function distributor(){
        return $this->belongsTo('App\Distributor', 'distributor_id', 'id');
    }

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function itemOrders(){
        return $this->hasMany('App\ItemOrder');
    }
}

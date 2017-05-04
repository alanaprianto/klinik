<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'hospital_id'
    ];

    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    public function depo(){
        return $this->hasOne('App\Depo');
    }

    public function pharmacyTransactions(){
        return $this->hasMany('App\PharmacyTransaction');
    }
}

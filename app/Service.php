<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'cost',
        'desc'
    ];

    public function medicalRecords(){
        return $this->hasMany('App\MedicalRecord');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function inventories(){
        return $this->belongsToMany('App\Inventory', 'services_inventories', 'services_id', 'inventories_id');
    }
}

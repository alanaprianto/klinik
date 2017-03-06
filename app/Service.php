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
}

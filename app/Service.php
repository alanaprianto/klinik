<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'cost',
    ];
    public function medicalRecords()
    {
        return $this->belongsToMany('App\MedicalRecord', 'medical_records_services', 'medical_records_id', 'services_id');
    }
}

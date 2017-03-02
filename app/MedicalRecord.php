<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'reference_id',
        'patient_id',
    ];

    public function reference()
    {
        return $this->belongsTo('App\Reference', 'reference_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function staff()
    {
        return $this->belongsToMany('App\Staff', 'staff_medical_records', 'staff_id', 'medical_records_id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service', 'medical_records_services', 'services_id', 'medical_records_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'reference_id',
        'patient_id',
        'service_id',
        'quantity',
        'subsidy',
        'total_sum',
        'total_payment',
        'notes',
        'type',
        'anamnesa',
        'diagnosis',
        'explain',
        'therapy',
        'icd10'

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

    public function service(){
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }
}

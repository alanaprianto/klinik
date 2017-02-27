<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'number_medical_record',
        'full_name',
        'place',
        'birth',
        'age',
        'gender',
        'address',
        'religion',
        'province',
        'city',
        'district',
        'sub_district',
        'rt_rw',
        'phone_number',
        'last_education',
        'job',
        'responsible_person',
        'responsible_person_state',
        'responsible_person_last_education',
        'responsible_person_job',
        'askes_number',
        'cause_pain',
        'service_type',
        'time_attend',
        'how_visit',
        'payment_method',
        'kiosk_id'
    ];

    /*belong*/
    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    /*main*/
    public function register(){
        return $this->hasMany('App\Registration');
    }

    public function visits(){
        return $this->hasMany('App\Visit');
    }

    public function histories(){
        return $this->hasMany('App\History');
    }
}

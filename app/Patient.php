<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'register_number',
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
        'askes_number',
        'cause_pain',
        'how_visit',
        'time_attend',
        'service_type',
        'first_diagnose',
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

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'nik',
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
        'staff_job_id',
        'hospital_id'
    ];


    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    public function staffJob(){
        return $this->belongsTo('App\StaffJob', 'staff_job_id', 'id');
    }

    public function staffPosition(){
        return $this->hasOne('App\StaffPosition');
    }

    public function register(){
        return $this->hasMany('App\Register');
    }

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function polies(){
        return $this->belongsToMany('App\Poly', 'doctors_polies', 'polies_id', 'staff_id');
    }

    public function medicalRecords()
    {
        return $this->belongsToMany('App\MedicalRecord', 'staff_medical_records', 'medical_records_id', 'staff_id');
    }
    public function setBirthAttribute($value)
    {
        if ($value) {
            $this->attributes['birth'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }
}

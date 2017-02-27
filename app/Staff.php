<?php

namespace App;

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
        'staff_job_id'
    ];

    public function registration(){
        return $this->hasMany('App\Registration');
    }

    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    public function staffJob(){
        return $this->belongsTo('App\StaffJob', 'staff_job_id', 'id');
    }

    public function staffPosition(){
        return $this->hasOne('App\StaffPosition');
    }

}

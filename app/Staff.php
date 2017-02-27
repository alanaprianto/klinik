<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    public function registration(){
        return $this->hasMany('App\Registration');
    }

    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    public function staffJob(){
        return $this->belongsTo('App\StaffJob', 'staff_job_id', 'id');
    }

    public function staffPositions(){
        return $this->hasOne('App\StaffPosition');
    }
}

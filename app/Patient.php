<?php

namespace App;

use Carbon\Carbon;
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
        'askes_number',
    ];

    /*belong*/
    public function hospital(){
        return $this->belongsTo('App\Hospital', 'hospital_id', 'id');
    }

    public function registers(){
        return $this->hasMany('App\Register');
    }

    /*mutator set*/
    public function setBirthAttribute($value)
    {
        if ($value) {
            $this->attributes['birth'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }

    public function getBirthAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [
        'register_number',
        'staff_id',
        'patient_id',
        'status',
        'notes',
        'responsible_person',
        'responsible_person_state',
        'cause_pain',
        'how_visit',
        'time_attend',
        'service_type',
        'first_diagnose',
        'payment_status',
        'total_customer_payment',
        'type'
    ];

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function references(){
        return $this->hasMany('App\Reference');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function paymentHistories(){
        return $this->hasMany('App\PaymentHistory');
    }

    public function setTimeAttendAttribute($value)
    {
        if ($value) {
            $this->attributes['time_attend'] = Carbon::createFromFormat('g:i A', $value);
        }
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'number_reference',
        'register_id',
        'poly_id',
        'status',
        'notes',
        'staff_id',
        'is_checked',
        'payment_status',
        'reference_total_payment',
        'room_id'
    ];

    public function register()
    {
        return $this->belongsTo('App\Register', 'register_id', 'id');
    }

    public function poly()
    {
        return $this->belongsTo('App\Poly', 'poly_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function medicalRecords()
    {
        return $this->hasMany('App\MedicalRecord');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function room(){
        return $this->belongsTo('App\ClassRoom', 'room_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'register_id',
        'poly_id',
        'status',
        'notes',
        'staff_id',
        'is_checked',
        'final_result'
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
}

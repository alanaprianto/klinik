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
        'staff_id'
    ];

    public function register(){
        return $this->belongsTo('App\Register','register_id', 'id');
    }

    public function poly(){
        return $this->belongsTo('App\Poly', 'poly_id', 'id');
    }

    public function doctor(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

    public function medicalRecord(){
        return $this->hasOne('App\MedicalRecord');
    }
}

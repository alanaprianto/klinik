<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'date'
    ];

    /*belong*/
    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function poly(){
        return $this->belongsTo('App\Visit', 'poly_id', 'id');
    }

    public function history(){
        return $this->hasOne('App\History');
    }
}

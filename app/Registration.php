<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'number_registration'
    ];
    /*belong*/
    public function kiosk(){
        return $this->belongsTo('App\Kiosk', 'kiosk_id', 'id');
    }

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
    
    public function history(){
        return $this->hasOne('App\History');
    }

}

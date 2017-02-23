<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function registration()
    {
        return $this->belongsTo('App\Registration', 'registration_id', 'id');
    }

    public function historyType()
    {
        return $this->belongsTo('App\HistoryType', 'history_type_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function visit()
    {
        return $this->belongsTo('App\Patient', 'visit_id', 'id');
    }
}

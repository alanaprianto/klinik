<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $fillable = [
        'queue_number',
        'date',
        'status',
        'type',
        'locket'
    ];

    /*main relation*/
    public function registration(){
        return $this->hasOne('App\Registration');
    }
}

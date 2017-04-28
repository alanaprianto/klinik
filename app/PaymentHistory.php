<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'payment',
        'register_id'
    ];

    public function register(){
        return $this->belongsTo('App\Register', 'register_id', 'id');
    }
}

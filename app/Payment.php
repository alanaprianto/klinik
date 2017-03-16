<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'type',
        'total',
        'status',
        'register_id',
        'reference_id'
    ];
    public function reference(){
        return $this->belongsTo('App\Reference', 'reference_id', 'id');
    }
    public function register(){
        return $this->belongsTo('App\Register', 'register_id', 'id');
    }
}

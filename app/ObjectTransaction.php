<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectTransaction extends Model
{
    protected $fillable = [
        'number_transaction',
        'object_id'
    ];

    public function object(){
        return $this->belongsTo('App\Object', 'object_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectPrice extends Model
{
    protected $fillable = [
        'price',
        'tax',
        'discount',
        'object_id'
    ];

    public function object(){
        return $this->belongsTo('App\Object', 'object_id', 'id');
    }
}

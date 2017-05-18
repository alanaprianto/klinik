<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectDescription extends Model
{
    protected $fillable = [
        'desc',
        'about',
        'object_id'
    ];

    public function object(){
        return $this->belongsTo('App\Object', 'object_id', 'id');
    }
}
